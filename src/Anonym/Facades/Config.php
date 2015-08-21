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
use Anonym\Components\Config\Reposity;
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
    protected function getFacadeClass()
    {
        $configs = Singleton::bind(ConfigConstructor::class);
        return new Reposity($configs->getConfigs());
    }

}
