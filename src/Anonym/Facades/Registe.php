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

/**
 * Class Register
 * @package Anonym\Facades
 */
class Register extends Facade
{

    /**
     * get the register dispatcher facade
     *
     * @return RegisterDispatcher
     */
    protected static function getFacadeClass()
    {
        $base = Singleton::bind('database.base');
        $tables = Config::get('database.tables');
        return new RegisterDispatcher($base, $tables);
    }

}
