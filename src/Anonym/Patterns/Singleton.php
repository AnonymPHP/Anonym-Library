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
     * the instances of called binds
     *
     * @var array
     */
    private static $called;
    /**
     * make the singleton class
     *
     * @param string $class the name of class
     * @param callable $callback the callback for name
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function bind($class, callable $callback = null)
    {

        // $class must be a string
        if(!is_string($class))
        {
            throw new InvalidArgumentException(sprintf('Class name must be a string'));
        }

        // if is not binded, do it
        if (!static::isBinded($class))
        {
            static::$binded[$class] = $callback;
        }

        // if callback called before, return it
        if (static::isCalled($class)) {
            return static::$called[$class];
        }

        $response = call_user_func(static::$binded[$class]);
        static::$called[$class] = $response;
        return $response;
    }

    /**
     * check the binded
     *
     * @param string $name the name of bind
     * @return bool
     */
    public static function isBinded($name = '')
    {
        return isset(static::$binded[$name]);
    }

    /**
     * check the binded
     *
     * @param string $name the name of bind
     * @return bool
     */
    public static function isCalled($name = '')
    {
        return isset(static::$called[$name]);
    }

}
