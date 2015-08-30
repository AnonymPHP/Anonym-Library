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
 * Class Response
 * @package Anonym\Facades
 */
class Response extends Facade
{

    /**
     * @return mixed
     */
    protected static function getFacadeClass()
    {
        $response = App::make('http.response');
        return $response;
    }
}
