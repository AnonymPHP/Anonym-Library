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
        $base = App::make('database.base');
        $tables = Config::get('database.tables');
        return new LoginDispatcher($base, $tables);
    }
}
