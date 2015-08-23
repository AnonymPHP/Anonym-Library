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

use Closure;
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
     * @param mixed $callback the callback for name
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function bind($class, $callback = null)
    {

        // $class must be a string
        if(!is_string($class))
        {
            throw new InvalidArgumentException(sprintf('Class name must be a string'));
        }

        if (static::isBinded($class))
        {
            return static::$binded[$class];
        }

        $response = $callback instanceof Closure ? $callback() : $callback;
        static::$binded[$class] = $response;
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
