<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Providers;

use Anonym\Facades\Config;
use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\Event\EventCollector;

/**
 * Class EventProvider
 * @package Anonym\Providers
 */
class EventProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $events = Config::get('event.events');
        EventCollector::setListeners($events);
    }
}