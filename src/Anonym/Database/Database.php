<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

use ReflectionObject;

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
     * the instance of self
     *
     * @var Model
     */
    private static $booted;


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
        $this->getQueryBuilder()->datas['from'] = $this->table;
        $this->bootIfWasnt();
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
     * determine if is this class booted by static, if it is not boot it.
     */
    private function bootIfWasnt()
    {
        if (static::$booted === null) {
            static::$booted = $this;
        }
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
     * do an update query
     *
     * @param array $update
     * @return $this
     */
    public function update(array $update = [])
    {
        if (count($update) !== 0) {
            $this->getQueryBuilder()->update($update);
        }

        return $this->execute();
    }

    /**
     *  execute a query
     */
    private function execute()
    {
        $return = $this->getQueryBuilder()->execute();

        $this->query = $return['query'];
        $this->lastExecutes[] = $return['execute'];
        $this->lastPrepares[] = $return['prepare'];
        return $this;
    }

    /**
     *  execute a query
     */
    private function executeWithAttrs()
    {
        $return = $this->getQueryBuilder()->execute();

        $this->query = $return['query'];
        $this->lastExecutes[] = $return['execute'];
        $this->lastPrepares[] = $return['prepare'];
        $this->attributes = $return['prepare']->fetchAll();
        return $this;
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

        return $this->execute();
    }

    /**
     * set the selected table
     *
     * @param string $table
     * @return $this
     */
    public function table($table = ''){
        $this->table = $table;
        return $this;
    }

    /**
     *
     * @return string
     */
    private function findSelectedTable()
    {
        if (isset($this->vars['table']) && !empty($this->vars['table'])) {
            return $this->vars['table'];
        } else {
            $referer = new ReflectionObject($this);
            $this->table = strtolower($referer->getShortName());
        }
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
        return call_user_func_array([static::$booted, $name], $arguments);
    }
}