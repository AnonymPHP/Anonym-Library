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
use Anonym\Session\Stroge;
/**
 * the facade of session
 *
 * Class Session
 * @package Anonym\Facades
 */
class Session extends Facade
{
    /**
     *  get the facade instance
     * @return string
     */
    protected static function getFacadeClass()
    {
        return Stroge::class;
    }
}
