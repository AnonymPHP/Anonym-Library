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
use Anonym\Components\Element\Element as ElementDispatcher;
use Anonym\Patterns\Singleton;

/**
 * Class Element
 * @package Anonym\Facades
 */
class Element extends Facade
{
    /**
     * get the element facade
     *
     * @return Element
     */
    protected static function getFacadeClass()
    {
        $base = Singleton::bind('database.base');
        return new ElementDispatcher($base);
    }
}
