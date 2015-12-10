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
class Model
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
        if (!static::$booted || empty(static::$booted) || !static::$booted instanceof Model) {
            static::$booted = $this;
        }
    }

    /**
     * @return QueryBuilder
     */
    private function getQueryBuilder(){
        $base = static::$base;

        return $base::getQueryBuilder();
    }

    /**
     * do an update query
     *
     * @param array $update
     * @return $this
     */
    public function update(array $update = []){
        $update = count($update) !== 0 ? $this->getQueryBuilder()->update($update) : $this->getQueryBuilder();
        $return = $update->execute();

        $this->query = $return['query'];
        $this->lastExecutes[] = $return['execute'];
        $this->lastPrepares[] = $prepare =  $return['prepare'];
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
}
