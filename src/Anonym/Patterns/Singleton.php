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
    private static $binded;

    /**
     * make the singleton class
     *
     * @param string $class the name of class
     * @param callable $callback the callback for name
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function bind($class, callable $callback)
    {

        if(!is_string($class))
        {
            throw new InvalidArgumentException(sprintf('Class name must be a string'));
        }
        if (!static::isBinded($class))
        {
            static::$binded[$class] = $callback;
        }
        return call_user_func(static::$binded[$class]);
    }

    /**
     * check the binded
     *
     * @param string $name
     * @return bool
     */
    public static function isBinded($name = '')
    {
        return isset(static::$binded[$name]);
    }
}
