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
 * Class ErrorBag
 * @package Anonym\Facades
 */
class ErrorBag extends Facade
{

    /**
     * get facade class
     *
     * @return string
     */
    protected static function getFacadeClass(){
        return 'errors.bag';
    }

}
