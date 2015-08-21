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

class Event extends Facade
{

    /**
     * get the event facade
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return "Event";
    }

}