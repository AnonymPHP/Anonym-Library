<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

use Anonym\Billing\Billing;
use Anonym\Support\Arr;
use ReflectionObject;
use PDO;

/**
 * Class Model
 * @package Anonym\Database
 */
class Database
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
     * the variables of this class and children
     *
     * @var array
     */
    private $vars;

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
        $this->vars = get_class_vars(self::class);
        $this->table = $this->findSelectedTable();
    }

    /**
     *
     * @return string
     */
    private function findSelectedTable()
    {
        if (isset($this->vars['table']) && !empty($this->vars['table'])) {
            $this->table = $this->vars['table'];
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
    public static function setDatabaseApplication(Base $base)
    {
        static::$base = $base;
    }

    /**
     * @return QueryBuilder
     */
    private function getQueryBuilder()
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
     * returns first attribute
     *
     * @return mixed
     */
    public function getFirstAttribute()
    {
        return $this->getAttributes()[0];
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
