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
    private  $container;

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
        $this->container[$name] = $callback;
        if(true === $shared)
        {
            Singleton::bind($name, $callback);
        }
        return $this;
    }

    /**
     * @param $name
     * @param callable $callback
     */
    public function singleton($name, callable $callback)
    {

    }
}
