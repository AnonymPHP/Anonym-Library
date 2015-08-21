<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Patterns;
use ReflectionClass;

/**
 * Class Singleton
 * @package Anonym\Patterns
 */
class Singleton
{

    /**
     * the instances list
     *
     * @var array
     */
    private static $instances;

    /**
     * make the singleton class
     *
     * @param string $name the name of class
     * @param array $args the variables for constroctor
     */
    public static function make($name, $args = [])
    {

       foreach((array) $name as $class)
       {
           if (!isset(static::$instances[$class])) {
               $instance = new \ReflectionClass($class);
           }
       }

        $createReflectionInstance = new ReflectionClass($instance);
        $setParamsToCreatedReflectionInstance = $createReflectionInstance->newInstanceArgs($parametres);

    }
}