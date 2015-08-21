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
use Anonym\Components\Cache\DriverInterface;

class Cache extends Facade
{

    /**
     *  get the cache facade
     *
     * @return DriverInterface
     */
    protected static function getFacadeClass()
    {
        $configs = Config::get('stroge.cache');
        $driver = isset($configs['driver']) ? $configs['driver'] : '';

        return (new \Anonym\Components\Cache\Cache())->driver($driver, $configs);
    }

}