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

}
