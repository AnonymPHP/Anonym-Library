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

use Anonym\Application\Application;
use Anonym\Config\ConfigLoader;
use Anonym\Config\Reposity;

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
    public function __construct(Application $application)
    {

        $cachedPath = $application->getSystemPath(). 'cached_configs.php';

        $application->singleton('config', function () use($application) use($cachedPath){

            $driver = $application->getGeneral()['config'];

            $loader = new ConfigLoader($application->getConfigPath(), $cachedPath);

        });


        $cachedPath = SYSTEM . 'cached_configs.php';

        $loader = new ConfigLoader(CONFIG, $cachedPath);
        $configs = $loader->loadConfigs();
        Reposity::setCache($configs);

        // we will set default timezone
        date_default_timezone_set($configs['general']['timezone']);
    }

}
