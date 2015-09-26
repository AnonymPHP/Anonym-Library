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


use Anonym\Application\ServiceProvider;
use Anonym\Cookie\UseCookieHeaders;
use Anonym\Route\Router;
use Anonym\Facades\App;

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
        if (isset($_SERVER['HTTP_HOST'])) {
            include ROUTE_PHP;
            $router = new Router(App::make('http.request'));
            $router->run();
        }

        $cookies = new UseCookieHeaders();
        $cookies->useCookies();
    }
}