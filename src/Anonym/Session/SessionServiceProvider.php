<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Session;

use Anonym\Application\ServiceProvider;
use Anonym\Session\StrogeInterface;
use Anonym\Facades\Config;
use Anonym\Support\Arr;
use Anonym\Facades\App;


/**
 * Class SessionServiceProvider
 * @package Anonym\Session
 */
class SessionServiceProvider extends ServiceProvider
{

    /**
     * register the provider
     */
    public function register()
    {

        $session = new SessionManager(Config::get('stroge.session'), $this->app->make('crypt'));

        $session->extend(
            'cookie',
            function (array $configs = []) {
                $lifetime = Arr::get($configs, 'cookie.lifetime', 1800);

                $cookie = App::make('cookie');
                return new CookieSessionHandler($cookie, $lifetime);
            }
        );

        $session->extend(
            'database',
            function (array $configs = []) {
                $table = Arr::get($configs, 'database.table');

                $base = App::make('database.base');
                return new DatabaseSessionHandler($base, $table);
            }
        );

        $session->extend(
            'file',
            function (array $configs = []) {
                $filesystem = Stroge::disk('local');

                $path = Arr::get($configs, 'file.path', RESOURCE . 'sessions/');
                return new FileSessionHandler($filesystem, $path);
            }
        );

        $session->extend(
            'cache',
            function () {
                return App::make('cache');
            }
        );


        $this->instance(
            'session',
            $session
        );


        $app = $this;

        $this->singleton(Stroge::class, function () use ($app) {
            $driver = Config::get('stroge.session.driver');

            return $app->make('session')->driver($driver);
        }
        );
    }
}
