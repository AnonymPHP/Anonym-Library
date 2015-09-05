<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Container;

use ReflectionClass;
use Closure;

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
    protected static $aliases;

    /**
     * an array of types bindigs
     *
     * @var array
     */
    protected $bindings;

    /**
     * Determine if the given abstract type has been resolved.
     *
     * @param string $class
     * @return bool
     */
    protected function resolved($class)
    {
        return isset($this->instances[$class]);
    }

    /**
     * the add a new container
     *
     * @param string|array $class
     * @param callable $callback
     * @param bool $shared
     * @return mixed
     */
    public function bind($class, callable $callback = null, $shared = false)
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

        $this->bindings[$class] = compact('callback', 'shared');

        return $this->addInstance($class, $callback);
    }

    /**
     * add instance to cached instances
     *
     * @param string $class
     * @param Closure $callback
     * @return $this
     */
    protected function addInstance($class, $callback)
    {
        static::$container[$class] = $callback;

        return $this;
    }


    /**
     * Register a shared binding in the container.
     *
     * @param string $class
     * @param callable|null $callback
     */
    public function singleton($class, callable $callback = null)
    {
        $this->bind($class, $callback, true);
    }


    /**
     * make a instance from binded parameters
     *
     * @param mixed $abstract
     * @param array $parameters
     * @throws AliasNotFoundException
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        $alias = $this->getAlias($abstract);

        if (!$this->isBinded($alias)) {
             throw new AliasNotFoundException(sprintf('Target alias %s not found', $alias));
        }

        if (isset($this->instances[$alias])) {
            return $this->instances[$alias];
        }


        if ($this->isBuildable($alias, $parameters)) {
            $object = $this->build($alias, $parameters);
        } else {
            $object = $this->callClosure($alias, $parameters);
        }


        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * call the closure object
     *
     * @param string $abstract
     * @param array $parameters
     * @throws BindNotRespondingException
     * @throws BindResolutionException
     * @return mixed
     */
    protected function callClosure($abstract = '', $parameters = [])
    {
        $closure = static::$container[$abstract];

        if ($closure instanceof Closure) {
            if (null !== $response = call_user_func_array($closure, $parameters)) {
                return $response;
            } else {
                throw new BindNotRespondingException(sprintf('target %s is not found', $abstract));
            }
        } else {
            throw new BindResolutionException(sprintf('target %s is not an isntance of %s', $abstract, Closure::class));
        }
    }

    /**
     * create a new reflection class
     *
     * @param string $abstract
     * @param array $parameters
     * @throws BindResolutionException
     * @return mixed
     */
    public function build($abstract, $parameters = [])
    {
        if ($abstract instanceof $parameters) {
            return $abstract($this, $parameters);
        }

        $reflector = new ReflectionClass($abstract);

        if (!$reflector->isInstantiable()) {
            throw new BindResolutionException(sprintf('Target %s is not instantiable', $abstract));
        }

        // if there are not constructor, that mean we can return directly a new instance
        if (null === $reflector->getConstructor()) {
            return new $abstract;
        }

        return $reflector->newInstanceArgs($parameters);
    }

    /**
     * @param mixed $abstract
     * @param mixed $callback
     * @return bool
     */
    protected function isBuildable($abstract, $callback)
    {
        return $abstract === $callback || $callback instanceof Closure;
    }

    /**
     * get the is shared
     *
     * @param string $abstract
     * @return bool
     */
    public function isShared($abstract)
    {
        $shared = isset($this->bindings[$abstract]['shared']) ? $this->bindings[$abstract]['shared'] : false;

        return isset($this->instances[$abstract]) || $shared === true;
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
        unset(static::$aliases[$abstract], $this->instances[$abstract]);
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
        static::$aliases[$alias] = $class;
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
     * get the class alias
     *
     *
     * @param string $name
     * @return string
     */
    public function getAlias($name)
    {
        return isset(static::$aliases[$name]) ? static::$aliases[$name] : $name;
    }

    /**
     * @param array $alias
     * @return Container
     */
    public function setAlias(array $alias)
    {
        static::$aliases = $alias;

        return $this;
    }


}