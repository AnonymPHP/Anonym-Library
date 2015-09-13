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
 * Class Anonym
 * @package Anonym\Facades
 */
class Anonym extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeClass(){
        return App::make(Kernel::class, [App::make('app')]);
    }
}
