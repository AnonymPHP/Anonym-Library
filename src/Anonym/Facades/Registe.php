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
use Anonym\Components\Security\Authentication\Register as RegisterDispatcher;

class Register extends Facade
{

    protected static function getFacadeClass()
    {
        $base = Singleton::bind('database.base');
        $tables = Config::get('database.tables');
        return new RegisterDispatcher($base, $tables);
    }

}