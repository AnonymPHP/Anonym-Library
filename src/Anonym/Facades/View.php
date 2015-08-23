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


use Anonym\Components\View\ViewDriverManager;
use Anonym\Patterns\Facade;
/**
 * Class View
 * @package Anonym\Facades
 */
class View extends Facade
{

    /**
     * get the view facade
     *
     * @return \Anonym\Components\View\View
     */
    protected static function getFacadeClass()
    {
        $configs = Config::get('view');

        $driver = isset($configs['driver']) ? $configs['driver'] : 'twig';
        $manager = new ViewDriverManager();
        $instance = $manager->driver($driver, '', $configs);
        return $instance;
    }

}