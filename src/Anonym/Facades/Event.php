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
 * the facade of event
 *
 * Class Event
 * @package Anonym\Facades
 */
class Event extends Facade
{

    /**
     * get the event facade
     *
     * @return string
     */
    protected static function getFacadeClass()
    {
        return "Event";
    }
}
