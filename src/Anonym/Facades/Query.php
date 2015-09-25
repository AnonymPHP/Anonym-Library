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
use Anonym\Http\Query as Abst;

/**
 * Class Query
 * @package Anonym\Facades
 */
class Query extends Facade
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
