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
 * Class Csrf
 * @package Anonym\Facades
 */
class Csrf extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeClass(){
        return 'security.csrf';
    }

}
