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

use Anonym\Bootstrap\AliasLoader;
use InvalidArgumentException;
use Illuminate\Container\Container;

/**
 * Class Facade
 * @package Anonym\Patterns
 */
class Facade
{

    /**
     * the instance of container
     *
     * @var Container
     */
    protected static $container;

    /**
     * the resolved object instances
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * register the laravel container
     *
     * @param Container $container
     */
    public static function setApplication(Container $container){
        static::$container = $container;
    }

    /**
     * get the facade class
     *
     * @throws FacadeException
     * @return string|Object
     */
    protected static function getFacadeClass()
    {
        throw new FacadeException('i can not call myself');
    }

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string  $name
     * @return mixed
     */
    protected static function resolveFacadeClass($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }


        return static::$resolvedInstance[$name] = static::$container[$name];
    }

    /**
     * call the method in registered instances
     *
     * @param string $method the name of method
     * @param array $args the variables for method
     * @return mixed
     */
    public static function __callStatic($method, $args = [])
    {
        $instance = static::resolveFacadeClass(static::getFacadeClass());

        return call_user_func_array([$instance, $method], $args);
    }

    /**
     * call the method in registered instances
     *
     * @param string $method the name of method
     * @param array $args the variables for method
     * @return mixed
     */
    public function __call($method, $args)
    {
        $instance = static::resolveFacadeClass(static::getFacadeClass());

        return call_user_func_array([$instance, $method], $args);
    }
}