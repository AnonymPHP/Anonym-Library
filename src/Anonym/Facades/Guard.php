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

class Guard extends Facade
{

    /**
     * get a guard facade instance
     *
     * @return string
     */
    protected static function getFacadeClass(){
        return 'guard';
    }

}