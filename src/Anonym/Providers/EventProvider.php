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
use Anonym\Event\EventCollector;
use Anonym\Filesystem\Filesystem;
use Anonym\Application\ServiceProvider;

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

        if (Config::has('event.events')) {
            $events = Config::get('event.events');

            EventCollector::setListeners($events);


            if (file_exists( $path = APP . 'events.php')) {
                include $path;
            }
        }
    }
}