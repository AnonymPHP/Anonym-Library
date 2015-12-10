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
class Model extends Base
{


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
     * the constructor of Model .
     */
    public function __construct()
    {
        $this->vars = get_class_vars(self::class);
        $this->table = $this->findSelectedTable();
        $this->bootIfWasnt();
    }

    /**
     * determine if is this class booted by static, if it is not boot it.
     */
    private function bootIfWasnt(){
        if(!static::$booted || empty(static::$booted) || !static::$booted instanceof Model){
            static::$booted = $this;
        }
    }
    /**
     *
     * @return string
     */
    private function findSelectedTable(){
        if (isset($this->vars['table']) && !empty($this->vars['table'])) {
            return $this->vars['table'];
        }else{
            $referer = new ReflectionObject($this);
            $this->table = strtolower($referer->getShortName());
        }
    }
}
