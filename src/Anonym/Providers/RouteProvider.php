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


use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\Route\Router;
use Anonym\Facades\Config;

class RouteProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        // if php on server, run router
        if (!isset($_SERVER['argv'])) {
            include ROUTE_PHP;
            $router = new Router($this->make('http.request'));
            $router->run();
        }
    }
}