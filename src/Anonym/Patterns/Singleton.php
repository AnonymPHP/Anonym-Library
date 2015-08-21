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
use InvalidArgumentException;
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
     * @param string $class the name of class
     * @param array $args the variables for constroctor
     * @throws InvalidArgumentException
     */
    public static function make($class, $args = [])
    {

        if (!is_string($class)) {
            throw new InvalidArgumentException('Your singleton class name must be a string!');
        }

           if (!isset(static::$instances[$class])) {
               $instance = new \ReflectionClass($class);
               $instance = $instance->newInstanceArgs($args);
               static::$instances[$class] = $instance;
           }

        return static::$instances[$class];
    }
}
