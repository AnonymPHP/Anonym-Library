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
use Anonym\Components\Security\Authentication\Login as LoginDispatcher;

/**
 * Class Login
 * @package Anonym\Facades
 */
class Login extends Facade
{

    /**
     *get the login dispatcher facade
     *
     * @return LoginDispatcher
     */
    protected static function getFacadeClass()
    {

    }
}