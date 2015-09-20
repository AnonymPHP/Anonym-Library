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
use Anonym\Components\HttpClient\Query as Abst;

/**
 * Class Query
 * @package Anonym\Facades
 */
class Query extends Facade
{

    protected static function getFacadeClass(){
        return Abst::class;
    }
}
