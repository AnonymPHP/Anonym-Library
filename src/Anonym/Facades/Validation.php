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
 * Class Validation
 * @package Anonym\Facades
 */
class Validation extends Facade
{

    /**
     * return the validation facade
     *
     * @return string
     */
    protected static function getFacadeClass(){
        return 'validation';
    }

}
