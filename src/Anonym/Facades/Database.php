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
 * Class Database
 * @package Anonym\Facades
 */
class Database extends Facade
{

    /**
     * return the database base
     *
     * @return \Anonym\Database\Database
     */
    protected static function getFacadeClass()
    {
        return new \Anonym\Database\Database();
    }

}
