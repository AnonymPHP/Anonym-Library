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

use Anonym\Database\Base;

/**
 * Class Database
 * @package Anonym\Facades
 */
class Database
{

    /**
     * the instance of database base
     *
     * @var \Anonym\Database\Database
     */
    private static $base;


    /**
     * return the database base
     *
     * @return \Anonym\Database\Database
     */
    protected static function getFacadeClass()
    {

        if (static::$base === null) {
            static::$base = new \Anonym\Database\Database();
        }

        return static::$base;
    }

}
