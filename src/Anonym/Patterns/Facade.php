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

/**
 * Class Facade
 * @package Anonym\Patterns
 */
class Facade
{

    /**
     * register the instances
     *
     * @var array
     */
    private $instances;

    /**
     * get the facade class
     *
     * @throws FacadeException
     * @return string|Object
     */
    protected function getFacadeClass()
    {
        throw new FacadeException('i can not call myself');
    }

    /**
     * do resolve returned value
     *
     * @param mixed $class
     */
    protected function resolveFacadeClass($class)
    {
        if(is_string($class))
        {
            $class = new $class;
        }


    }

    /**
     * call the method in registered instances
     *
     * @param string $method the name of method
     * @param array $args the variables for method
     */
    public static function __callStatic($method, $args = [])
    {
        $instance = static::resolveFacadeClass(static::getFacadeClass());



    }
}
