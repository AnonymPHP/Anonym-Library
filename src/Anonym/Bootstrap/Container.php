<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Bootstrap;

use Anonym\Patterns\Singleton;

/**
 * the container class of framework
 *
 * Class Container
 * @package Anonym\Bootstrap
 */
class Container
{

    /**
     * the repository of classes
     *
     * @var array
     */
    protected static $container;

    /**
     * the add a new container
     *
     * @param string $name
     * @param callable $callback
     * @param bool $shared
     * @return mixed
     */
    public function bind($name, callable $callback, $shared = false)
    {
        if(true === $shared)
        {
            $this->singleton($name, $callback);
        } else {
            static::$container[$name] = $callback;
        }
        return $this;
    }

    /**
     * register a new singleton class
     *
     * @param string $name the name of singleton class
     * @param callable $callback
     * @return $this
     */
    public function singleton($name, callable $callback)
    {
        Singleton::bind($name, $callback);
        return $this;
    }

    /**
     * return a binded callback
     *
     * @param string $name the name of callback
     * @throws BindNotFoundException
     * @throws BindNotRespondingException
     * @return mixed
     */
    public function make($name = '')
    {
        if (isset(static::$container[$name]) || Singleton::isBinded($name)) {
            $bind = isset(static::$container[$name]) ? static::$container[$name] : Singleton::bind($name);
            $response = call_user_func($bind);
            if($response)
            {
                return $response;
            }else{
                throw new BindNotRespondingException(sprintf('Your %s bind It is does not give any response', $name));
            }
        }else{
            throw new BindNotFoundException(sprintf(''));
        }

    }

}
