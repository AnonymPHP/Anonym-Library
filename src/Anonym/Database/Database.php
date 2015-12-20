<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

use Anonym\Database\Exceptions\QueryException;
use Anonym\Billing\Billing;
use Anonym\Support\Arr;
use ReflectionObject;
use ArrayAccess;
use Iterator;
use PDO;


/**
 * Class Model
 * @package Anonym\Database
 */
class Database extends Megatron implements ArrayAccess, Iterator
{

    /**
     * the instance of Base
     *
     * @var Base
     */
    private static $base;

    /**
     * the name of selected table
     *
     * @var string
     */
    protected $table;


    /**
     * returns the attributes
     *
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var array
     */
    protected $lastExecutes;

    /**
     * @var array
     */
    protected $lastPrepares;

    /**
     * reposity of connected column name of id
     *
     * @var string
     */
    protected $connectedColumn = 'id';

    /**
     * the constructor of Model .
     */
    public function __construct()
    {
        $vars = get_class_vars(self::class);
        $this->table = $this->findSelectedTable($vars);
        parent::__construct($vars);
    }


    /**
     *
     * @param array $vars
     * @return string
     */
    private function findSelectedTable($vars = [])
    {
        if (isset($vars['table']) && !empty($vars['table'])) {
            $this->table = $vars['table'];
        } else {
            $referer = new ReflectionObject($this);
            $this->table = strtolower($referer->getShortName());
        }

        $this->getQueryBuilder()->datas['from'] = $this->table;
    }


    /**
     * find id or create a one
     *
     * @param string|int $id
     * @return $this
     */
    public function findOrCreate($id)
    {
        return $this->whereOrCreate($this->connectedColumn, $id);
    }

    /**
     * find the id or throw an exception
     *
     * @param string|id $id
     * @return Database
     * @throws QueryException
     */
    public function findOrFail($id)
    {
        return $this->whereOrFail($this->connectedColumn, $id);
    }

    /**
     * if you can find it, remove ,it
     *
     * @param string|id $id
     * @return Database
     */
    public function findAndRemove($id)
    {
        return $this->whereAndRemove($this->connectedColumn, $id);
    }

    /**
     * add a new where query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function where($index, $value = null)
    {
        $this->getQueryBuilder()->where($index, $value);

        $this->execute();

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        }

        return $this;
    }

    /**
     * find or create a new data
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function whereOrCreate($index, $value = null)
    {
        $this->getQueryBuilder()->where($index, $value);
        $this->execute();

        if ($value !== null) {
            $where = [$index => $value];
        } else {
            $where = $index;
        }

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        } else {
            $this->insert($where)->where($where);
        }

        return $this;
    }


    /**
     * add a new where and delete old data query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function whereAndRemove($index, $value = null)
    {
        $this->getQueryBuilder()->where($index, $value);
        $this->execute();

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->delete();
        }

        return $this;
    }


    /**
     * add a new where and delete old data query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     * @throws QueryException
     */
    public function whereOrFail($index, $value = null)
    {
        $this->getQueryBuilder()->where($index, $value);
        $this->execute();

        if (false === $this->getLastPrepare()->rowCount()) {
            throw new QueryException('Your last query was unsuccessful, please check it.');
        }

        return $this;
    }


    /**
     * add a new orwhere query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function orWhere($index, $value = null)
    {
        $this->getQueryBuilder()->orWhere($index, $value);
        $this->execute();
        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        }

        return $this;
    }


    /**
     * add a new orwhere query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     * @throws  QueryException
     */
    public function orWhereOrFail($index, $value = null)
    {
        $this->getQueryBuilder()->orWhere($index, $value);
        $this->execute();
        if (false === $this->getLastPrepare()->rowCount()) {
            throw new QueryException('Your last query was unsuccessful, please check it.');
        }

        return $this;
    }


    /**
     * find or create a new data
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function orWhereOrCreate($index, $value = null)
    {
        $this->getQueryBuilder()->orWhere($index, $value);
        $this->execute();

        if ($value !== null) {
            $where = [$index => $value];
        } else {
            $where = $index;
        }

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        } else {
            $this->insert($where)->where($where);
        }

        return $this;
    }


    /**
     * add a new where and delete old data query
     *
     * @param mixed $index
     * @param null $value
     * @return $this
     */
    public function orWhereAndRemove($index, $value = null)
    {
        $this->getQueryBuilder()->orWhere($index, $value);
        $this->execute();

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->delete();
        }

        return $this;
    }

    /**
     * @param mixed $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->getQueryBuilder()->limit($limit);

        $this->execute();
        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        }
    }

    /**
     * returns all attributes
     *
     * @return array
     */
    public function all()
    {
        return $this->getAttributes();
    }

    /**
     * returns first data
     *
     * @return bool
     */
    public function first()
    {
        $attr = $this->getAttributes();
        return isset($attr[0]) ? $attr[0] : false;
    }


    /**
     * get last row count
     *
     * @return mixed
     */
    public function exists()
    {
        return $this->getLastPrepare()->rowCount();
    }

    /**
     * @return mixed
     */
    public function isSuccess()
    {
        return $this->getLastResult();
    }


    /**
     * set the connected column names
     *
     * @param  string $connect
     * @return $this
     */
    public function on($connect)
    {
        $this->connectedColumn = $connect;
        return $this;
    }

    /**
     * find the datas with id datas
     *
     * @param string|id $id
     * @return $this
     */
    public function find($id)
    {
        return $this->where($this->connectedColumn, $id);
    }


    /**
     * add a new string query
     *
     * @param string $column
     * @param string $type
     * @return $this
     */
    public function order($column, $type = 'DESC')
    {
        $this->getQueryBuilder()->order($column, $type);
        $this->execute();

        if (false !== $lastFetch = $this->getLastPrepare()->rowCount()) {
            $this->attributes = $this->getLastPrepare()->fetchAll();
        }

        return $this;
    }

    /**
     * do an update query
     *
     * @param array $update
     * @return $this
     */
    public function update(array $update = [])
    {
        if (count($update) !== 0) {
            $this->getQueryBuilder()->set($update);
        }

        $this->getQueryBuilder()->datas['update'] = true;
        return $this->execute();
    }


    /**
     * find and destroy datas
     *
     * @param mixed $destroy
     * @return Database
     */
    public function destroy($destroy)
    {
        return $this->whereAndRemove($this->connectedColumn, $destroy);
    }


    /**
     * execute a delete query
     *
     * @return $this
     */
    public function delete()
    {
        $this->getQueryBuilder()->delete();
        return $this->execute();
    }


    /**
     * execute an insert query
     *
     * @param array $insert
     * @return $this
     */
    public function insert(array $insert = [])
    {
        if (count($insert) !== 0) {
            $this->getQueryBuilder()->set($insert);
        }
        $this->getQueryBuilder()->datas['insert'] = true;
        return $this->execute();
    }

    /**
     * returns new billing instance
     *
     * @return Billing
     */
    public function billing()
    {
        if ($this->table === 'User') {
            if (isset($this->attributes) && is_array($this->attributes)) {
                return (new Billing($this->attributes['id']))->on('billing_id');
            }
        }
    }

    /**
     * set the selected table
     *
     * @param string $table
     * @return $this
     */
    public function table($table = '')
    {
        return (new Database())->setTable($table);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }


    /**
     * register the last values
     *
     * @param array $return
     */
    private function setLastValues($return)
    {
        $this->query = Arr::get($return, 'query');
        $this->lastExecutes = Arr::get($return, 'execute');
        $this->lastPrepares = Arr::get($return, 'prepare');
    }

    /**
     *  execute a query
     */
    private function execute()
    {
        $return = $this->getQueryBuilder()->execute();
        $this->setLastValues($return);
        return $this;
    }

    /**
     *  execute a query
     */
    private function executeWithAttrs()
    {
        $return = $this->getQueryBuilder()->execute();
        $this->setLastValues($return);

        $this->attributes = Arr::get('prepare', $return)->fetch(PDO::FETCH_ASSOC);
        return $this;
    }

    /**
     * register the database
     *
     * @param Base $base
     */
    public static function setDatabaseApplication($base)
    {
        static::$base = $base;
    }

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder()
    {
        $base = static::$base;
        return $base::getQueryBuilder();
    }


    /**
     * returns last executes result
     *
     * @return mixed
     */
    public function getLastResult()
    {
        return end($this->lastExecutes);
    }

    /**
     * returns last query instance
     *
     * @return mixed
     */
    public function getLastQuery()
    {
        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getLastPrepare()
    {
        return end($this->lastPrepares);
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return Base
     */
    public static function getBase()
    {
        return self::$base;
    }

    /**
     * returns the parameters
     *
     * @return mixed
     */
    public function getParameters()
    {
        return $this->getQueryBuilder()->datas['parameters'];
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        call_user_func_array([$this->getQueryBuilder(), $name], $arguments);

        return $this->executeWithAttrs();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([new self(), $name], $arguments);
    }

    /**
     * returns the an value of attributes
     *
     * @param string $name
     * @return null
     */
    public function __get($name)
    {
        $attr = $this->first();

        return isset($attr[$name]) ? $attr[$name] : null;
    }

    /**
     * register new values
     *
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->getQueryBuilder()->datas['set'][$name] = $value;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->first()[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->first()[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->first()[$offset]);
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->attributes);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->attributes);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->attributes);
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        $key = key($this->attributes);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->attributes);
    }
}
