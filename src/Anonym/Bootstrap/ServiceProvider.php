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

/**
 * Class ServiceProvider
 * @package Anonym\Bootstrap
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
