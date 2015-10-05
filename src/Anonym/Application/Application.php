<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Application;

use Closure;
use Anonym\Facades\Event;

/**
 * Class ServiceProvider
 * @package Anonym\Application
 */
abstract class ServiceProvider
{

    /**
     * the instance of application
     *
     * @var Application
     */
    protected $app;

    /**
     * register the provider
     *
     * @return mixed
     */
    abstract public function register();

    /**
     * create a new instance and register application
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * listen a event
     *
     * @param string $listen
     * @param mixed $callback
     * @return $this
     */
    public function listenEvent($listen, $callback)
    {
        Event::listen($listen, $callback);

        return $this;
    }

    /**
     * regiter an application after event
     *
     * @param Closure $after
     * @return $this
     */
    public function after(Closure $after)
    {
        Application::after($after);
        return $this;
    }


    /**
     * register an application before event
     *
     * @param Closure $before
     * @return $this
     */
    public function  before(Closure $before)
    {
        Application::before($before);
        return $this;
    }

    /**
     * return the application instance
     *
     * @return Application
     */
    public function app()
    {
        return $this->app;
    }

    /**
     * call the method from application
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->app(), $method], $args);
    }
}
