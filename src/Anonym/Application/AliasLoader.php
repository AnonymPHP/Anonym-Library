<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Application;

/**
 * Class AliasLoader
 * @package Anonym\Application
 */
class AliasLoader
{

    /**
     * the type of array for aliases
     *
     * @var array
     */
    private static $aliases;


    /**
     * load a class with it's alias
     *
     * @param string $alias
     * @return bool
     */
    public function load($alias){

        if (isset(static::$aliases[$alias])) {
            return class_alias(static::$aliases[$alias], $alias);
        }
    }

    /**
     *  register the laod method to autoload callback
     */
    public function register(){
        spl_autoload_register([$this, 'load'], true, true);
    }

    /**
     * Add an alias to the loader.
     *
     * @param  string  $class
     * @param  string  $alias
     * @return void
     */
    public function alias($class, $alias)
    {
        static::$aliases[$class] = $alias;
    }

}