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
use Anonym\Facades\Event;
use Illuminate\Container\Container;
/**
 * Class ServiceProvider
 * @package Anonym\Application
 */
abstract class ServiceProvider extends Container
{


    /**
     * register the provider
     *
     * @return mixed
     */
    abstract public function register();


    /**
     * listen a event
     *
     * @param string $listen
     * @param mixed $callback
     * @return $this
     */
    public function listenEvent($listen, $callback){
        Event::listen($listen, $callback);

        return $this;
    }

}
