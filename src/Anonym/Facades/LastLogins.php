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
use Anonym\Auth\LastLogins as Login;

class LastLogins extends Facade
{

    /**
     * @return Login
     */
    protected static function getFacadeClass(){
        return new Login(App::make('database.base'));
    }

}
