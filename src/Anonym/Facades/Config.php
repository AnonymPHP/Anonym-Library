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

use Anonym\Components\Config\ConfigLoader;
use Anonym\Components\Config\Reposity;
use Anonym\Patterns\Facade;
use Anonym\Patterns\Singleton;
use Anonym\Constructors\ConfigConstructor;

/**
 * the facade for config
 *
 * Class Config
 * @package Anonym\Facades
 */
class Config extends Facade
{

    /**
     *
     * @return Repository
     */
    protected static function getFacadeClass()
    {
        $loader = App::make(ConfigConstructor::class);
        Reposity::setCache($loader->getConfigs());
        return new Reposity();
    }

}
