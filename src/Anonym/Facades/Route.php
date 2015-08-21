<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Facades;


use Anonym\Patterns\Facade;

/**
 * Class Route
 * @package Anonym\Facades
 */
class Route extends Facade
{

    /**
     * get the route facade class
     *
     *
     * @return string
     */
    protected static function getFacadeClass()
    {
        return "Route";
    }
}
