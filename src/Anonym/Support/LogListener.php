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


use Anonym\Facades\Stroge;

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

    private static function createContent(array $parameters)
    {
        $time = date('d.m.Y H:i');
        return sprintf('[%s] >>> %s -> %s -> %d', $time, $parameters['message'], $parameters['file'], $parameters['line']);
    }
    /**
     * @param array $parameters
     */
    public static function sendLog(array $parameters)
    {
        $file = APP . 'logs/error.log';
        $driver = Stroge::disk('local');
        if (!$driver->exists($file)) {
            $driver->create($file);
        }

        $driver->put($file, static::createContent($parameters));
    }
}
