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
use Closure;

/**
 * the container class of framework
 *
 * Class Container
 * @package Anonym\Bootstrap
 */
trait Container
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
        if (true === $shared) {
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
     * @param mixed $callback
     * @return $this
     */
    public function singleton($name, $callback = null)
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
        if (isset(static::$container[$name])) {
            $bind = static::$container[$name];
        } elseif (Singleton::isBinded($name)) {
            $bind = Singleton::bind($name);
        } elseif ($this->isFacade($name)) {
            $bind = $this->facade($name);
        }else{
            return false;
        }

        $response = $bind instanceof Closure ? $bind() : $bind;
        if ($response) {
            return $response;
        } else {
            throw new BindNotRespondingException(sprintf('Your %s bind It is does not give any response', $name));
        }

    }

    /**
     * create a new facade instance
     *
     * @param string $name the name of facade
     * @return mixed
     */
    public function facade($name = '')
    {

    }

    /**
     * if is facade return true
     *
     * @param string $name
     * @return bool
     */
    protected function isFacade($name = '')
    {
        if (strstr($name, 'facades.')) {
            return true;
        }
    }

    /**
     * check the binded
     *
     * @param string $name the name of bind
     * @param bool|false $share
     * @return bool
     */
    public function isBinded($name, $share = false)
    {
        return $share === true ? Singleton::isBinded($name) : isset(static::$container[$name]);
    }

}
