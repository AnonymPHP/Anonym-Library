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
        return 'cache';
    }

}
