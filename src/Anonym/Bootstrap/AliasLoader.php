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
     * @throws AliasNotFoundException
     * @return mixed
     */
    public function load($class = '')
    {

        $instances = static::getInstances();
        if (!strpos($class, '\\')) {
            $instance = isset($instances[$class]) ? $instances[$class] : false;
        } else {
            $instance = $class;
        }

        if (false !== $instance) {
            if (is_object($instance)) {
                return $instance;
            } else {
                return new $instance;
            }
        } else {
            throw new AliasNotFoundException(sprintf('your %s alias not found', $class));
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