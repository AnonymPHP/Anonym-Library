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
        return 'config';
    }

}
