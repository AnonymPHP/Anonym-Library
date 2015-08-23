<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Support;


class LogListener
{

    /**
     * check the logger registered
     *
     * @var bool
     */
    private static $registered;

    /**
     * @return boolean
     */
    public static function isRegistered()
    {
        return self::$registered;
    }

    /**
     * @param boolean $registered
     */
    public static function setRegistered($registered)
    {
        self::$registered = $registered;
    }

    /**
     * @param array $parameters
     */
    public static function sendLog(array $parameters)
    {

    }
}
