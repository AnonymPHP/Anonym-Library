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
use InvalidArgumentException;
use Closure;

/**
 * the container class of framework
 *
 * Class Container
 * @package Anonym\Bootstrap
 */
abstract class Container
{

    /**
     * the repository of classes
     *
     * @var array
     */
    protected static $container;


    /**
     * an array of types has been resolved
     *
     * @var array
     */
    protected $instances = [];
    /**
     * get facade alias
     *
     * @var array
     */
    protected $aliases;


    /**
     * the add a new container
     *
     * @param string|array $class
     * @param callable $callback
     * @param bool $shared
     * @return mixed
     */
    public function bind($class, callable $callback, $shared = false)
    {

        // if class name is array we will parse the alias name
        if (is_array($class)) {
            list($class, $alias) = $this->extractAlias($class);

            $this->alias($class, $alias);
        }

        $this->dropStaleInstances($class);

        if (is_null($callback)) {
            $callback = $class;
        }

        if (!$callback instanceof Closure) {
            $callback = $this->getClosure($class, $callback);
        }

        return $this;
    }

    /**
     * get closure from string
     *
     * @param string $class
     * @param string $callback
     * @return Closure
     */
    protected function getClosure($class, $callback)
    {
        return function ($app, $parameters = []) use ($class, $callback) {
            $method = ($callback === $class) ? 'build' : 'make';

            return $app->$method($callback, $parameters);
        };

    }

    /**
     * remove the $abstract from aliases and instances
     *
     * @param string $abstract
     */
    protected function dropStaleInstances($abstract)
    {
        unset($this->aliases[$abstract], $this->instances[$abstract]);
    }

    /**
     * get the alias
     *
     * @param array $classes
     * @return array
     */
    protected function extractAlias(array $classes = [])
    {
        return [key($classes), current($classes)];
    }

    /**
     * register a alias
     *
     * @param string $class
     * @param string $alias
     * @return $this
     */
    public function alias($class, $alias)
    {
        $this->aliases[$alias] = $class;
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
        if (isset(static::$instances[$name])) {
            $bind = static::$instances[$name];
        } elseif (Singleton::isBinded($name)) {
            $bind = Singleton::bind($name);
        } elseif ($this->bindIsFacade($name)) {
            $bind = $this->facade($name);
        } else {
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
     * if is facade return true
     *
     * @param string $name
     * @return bool
     */
    protected function bindIsFacade($name = '')
    {
        if (strstr($name, 'facades.')) {
            return true;
        }
    }

    /**
     * call the singleton::isBinded
     *
     * @param string $name
     * @return bool
     */
    public function isSingleton($name)
    {
        return Singleton::isBinded($name);
    }

    /**
     * check the binded
     *
     * @param string $name the name of bind
     * @return bool
     */
    public function isBinded($name)
    {
        return isset(static::$container[$name]);
    }

    /**
     * @return array
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param array $alias
     * @return Container
     */
    public function setAlias(array $alias)
    {
        $this->alias = $alias;

        return $this;
    }


}
