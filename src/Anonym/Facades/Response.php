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

class Response extends Facade
{


    /**
     * @return mixed
     */
    protected static function getFacadeClass()
    {
        $response = Singleton::bind('http.response');
        return $response;

    }
}
