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
 * the facade of cookie
 *
 * Class Cookie
 * @package Anonym\Facades
 */
class Cookie extends Facade
{

    /**
     * get the facade class
     *
     * @return string
     */
    protected static function getFacadeClass()
    {
        return "Cookie";
    }
}

