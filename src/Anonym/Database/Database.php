<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

use Anonym\Billing\Billing;
use Anonym\Database\Exceptions\QueryException;
use Anonym\Support\Arr;
use ReflectionObject;
use PDO;

/**
 * Class Model
 * @package Anonym\Database
 */
class Database extends Megatron
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
            $this->attributes = $this->getLastPrepare()->fetch(PDO::FETCH_ASSOC);
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
            $this->attributes = $this->getLastPrepare()->fetch(PDO::FETCH_ASSOC);
        } else {
            $this->insert($where)->where($where);
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
            $this->attributes = $this->getLastPrepare()->fetch(PDO::FETCH_ASSOC);
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
    public function whereAndDelete($index, $value = null)
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
                return new Billing($this->attributes['id']);
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
        $this->table = $table;
        $this->getQueryBuilder()->datas['from'] = $table;
        $this->attributes = [];
        $this->lastExecutes = [];
        $this->lastPrepares = [];
        $this->query = null;
        return $this;
    }

    /**
     * register the last values
     *
     * @param array $return
     */
    private function setLastValues($return)
    {
        $this->query = Arr::get('query', $return);
        $this->lastExecutes = Arr::get('execute', $return);
        $this->lastPrepares = Arr::get('prepare', $return);
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
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
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
}
