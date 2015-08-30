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
use Anonym\Patterns\Singleton;

/**
 * Class Request
 * @package Anonym\Facades
 */
class Request extends Facade
{

    /**
     * @return mixed
     */
    protected static function getFacadeClass()
    {
        $request = App::make('http.request');
        return $request;
    }

}
