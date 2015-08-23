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


use Anonym\Bootstrap\Container;
use Anonym\Patterns\Facade;
use Anonym\Patterns\Singleton;

/**
 * Class Request
 * @package Anonym\Facades
 */
class Request extends Facade
{
    use Container;

    private static function getFacadeClass()
    {
        $request = Singleton::bind('http.request');
        return $request;
    }

}