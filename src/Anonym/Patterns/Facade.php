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
     * load the facade instance
     *
     * @return bool|Object
     * @throws FacadeException
     */
    private static function getContainer()
    {
        if (!static::$container instanceof Container) {
            static::$container = new Container();
        }

        return static::$container;
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
     * do resolve returned value
     *
     * @param mixed $class
     * @throws InvalidArgumentException
     * @return Object|bool
     *
     */
    private static function resolveFacadeClass($class)
    {
        $instance = $class;
        $class = is_string($class) ? $class : get_class($class);

        $container = static::getContainer();

        if (!$container->resolved($class)) {
            $container->singleton($class, function () use ($instance) {
                if (is_string($instance)) {
                    return (new AliasLoader())->load($instance);
                } elseif (is_object($instance) && !$instance instanceof Facade) {
                    return $instance;
                } else {
                    throw new InvalidArgumentException('Your class cant be an instance of facade or anything else');
                }
            });
        }

        return $class;
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