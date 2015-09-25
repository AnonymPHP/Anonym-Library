<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Tools;

/**
 * Class Blueprint
 * @package Anonym\Database\Tools\Backup
 */
class Blueprint
{

    /**
     * the list of commands
     *
     * @var array
     */
    private static $command;

    /**
     * @param mixed $value
     * @return Chield
     */
    public static function command($value)
    {
       return static::$command[] = $value;
    }

    /**
     * @return array
     */
    public static function getCommand()
    {
        return self::$command;
    }

    /**
     * @param array $command
     */
    public static function setCommand($command)
    {
        self::$command = $command;
    }



}
