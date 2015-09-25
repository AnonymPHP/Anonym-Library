<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Route;

/**
 * Interface ControllerDispatcherInterface
 * @package Anonym\Route
 */
interface ControllerDispatcherInterface
{

    /**
     * dispatch the controller
     *
     * @return \Anonym\Route\Controller
     */
    public function dispatch();
}
