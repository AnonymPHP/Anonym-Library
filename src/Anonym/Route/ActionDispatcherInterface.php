<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Route;

/**
 * The interface of action dispatcher class
 *
 * Interface ActionDispatcherInterface
 * @package Anonym\Route
 */
interface ActionDispatcherInterface
{

    /**
     * Dispatch a action from array
     *
     * @param array $action
     * @return mixed
     */
    public function dispatch($action = []);
}
