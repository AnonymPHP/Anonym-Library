<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Bootstrap;


/**
 * the loader for alias
 *
 * Class AliasLoader
 * @package Anonym\Bootstrap
 */
class AliasLoader
{

    /**
     * the list of alias
     *
     * @var array
     */
    private static $instances;


    /**
     * load the facade class
     *
     * @param string $class
     * @return mixed
     */
    public function load($class = '')
    {

        $instances = static::getInstances();
        if (!strpos($class, '\\')) {
            $class = isset()
        }

    }

    /**
     * @return array
     */
    public static function getInstances()
    {
        return self::$instances;
    }

    /**
     * @param array $instances
     */
    public static function setInstances($instances)
    {
        self::$instances = $instances;
    }



}