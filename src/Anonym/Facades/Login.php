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
use Anonym\Patterns\Singleton;

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
        $base = Singleton::bind('database.base');
        $tables = Config::get('database.login');
        return new LoginDispatcher($base, $tables);
    }
}
