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
use Anonym\View\View as Manager;
/**
 * Class View
 * @package Anonym\Facades
 */
class View extends Facade
{

    /**
     * get the view facade
     *
     * @return \Anonym\View\View
     */
    protected static function getFacadeClass()
    {
       Return Manager::class;
    }

}