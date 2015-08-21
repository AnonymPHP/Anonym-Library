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
     */
    public static function bind($class, callable $callback)
    {


    }
}
