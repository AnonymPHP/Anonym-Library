<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Session;

use Anonym\Bootstrap\ServiceProvider;
use Anonym\Facades\Config;
use Anonym\Support\Arr;
use Anonym\Facades\App;
use Anonym\Facades\Stroge;
use Anonym\Components\Cache\Cache;
use Anonym\Components\Cookie\Cookie;
use Anonym\Components\Crypt\Crypter;
/**
 * Class SessionServiceProvider
 * @package Anonym\Components\Session
 */
class SessionServiceProvider extends ServiceProvider
{

    /**
     * register the provider
     */
    public function register()
    {

        $session = new SessionManager(Config::get('stroge.session'), App::make('crypt'));

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

        $this->singleton(
            'session',
            function () use ($session) {
                return $session;
            }
        );

        $this->singleton(
            'session.stroge',
            function () {
                $driver = Config::get('stroge.session.driver');

                return App::make('session')->driver($driver);
            }
        );
    }
}
