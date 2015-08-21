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
use Anonym\Patterns\Facade;


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
        $loader = new ConfigLoader(CONFIG);
    }

}
