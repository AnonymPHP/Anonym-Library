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
use Anonym\Bootstrap\Container;
use InvalidArgumentException;

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
        $class = is_string($class) ? $class : get_class($class);

        $container = static::getContainer();
        $container->singleton($class, function () use ($class) {
            if (is_string($class)) {
                return (new AliasLoader())->load($class);
            } elseif (is_object($class) && !$class instanceof Facade) {
                return $class;
            } else {
                throw new InvalidArgumentException('Your class cant be an instance of facade or anything else');
            }
        });

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
        $class = static::resolveFacadeClass(static::getFacadeClass());
        $instance = static::getContainer()->make($class);

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
        $class = static::resolveFacadeClass(static::getFacadeClass());
        $instance = static::getContainer()->make($class);

        return call_user_func_array([$instance, $method], $args);
    }
}