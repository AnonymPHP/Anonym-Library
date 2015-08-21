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

use Anonym\Bootstrap\Bootstrap;
use Anonym\Components\Config\ConfigLoader;

/**
 * the config constructor
 *
 * Class ConfigConstructor
 * @package Anonym\Constructors
 */
class ConfigConstructor
{

    /**
     * load the config files
     *
     * @return array
     */
    public function getConfigs()
    {
        $loader = new ConfigLoader(CONFIG);
        return $loader->loadConfigs();
    }
}
