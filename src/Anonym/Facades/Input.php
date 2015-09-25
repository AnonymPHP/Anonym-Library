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
use Anonym\Http\Input as Abst;

/**
 * Class Input
 * @package Anonym\Facades
 */
class Input extends Facade
{

    /**
     * get the query facade
     *
     * @return string
     */
    protected static function getFacadeClass(){
        return Abst::class;
    }
}
