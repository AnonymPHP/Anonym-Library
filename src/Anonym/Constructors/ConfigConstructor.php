<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Constructors;

use Anonym\Components\Config\ConfigLoader;
use Anonym\Components\Config\Reposity;

/**
 * the config constructor
 *
 * Class ConfigConstructor
 * @package Anonym\Constructors
 */
class ConfigConstructor
{

    /**
     * create a new instance and set the configs
     *
     */
    public function __construct()
    {
        $loader = new ConfigLoader(CONFIG);
        $configs = $loader->loadConfigs();
        Reposity::setCache($configs);

        // we will set default timezone
        date_default_timezone_set($configs['general']['timezone']);
    }

}
