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
use Anonym\Crypt\Crypter;
use Anonym\Facades\Stroge as FileStroge;
use Anonym\Facades\Config;
use Anonym\Support\Arr;


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

        $app = $this->app;

        $crypt = $app->make(Crypter::class);

        $session = $app->make(
            SessionManager::class,
            [
                $crypt,
                $app['config']->get('stroge.session')
            ]
        );

        $session->extend(
            'cookie',
            function (array $configs = []) use($app) {
                $lifetime = Arr::get($configs, 'cookie.lifetime', 1800);

                $cookie =$app->make('cookie');
                return new CookieSessionHandler($cookie, $lifetime);
            }
        );

        $session->extend(
            'database',
            function (array $configs = []) use($app) {
                $table = Arr::get($configs, 'database.table');

                $base = $app->make('database.base');
                return new DatabaseSessionHandler($base, $table);
            }
        );

        $session->extend(
            'file',
            function (array $configs = []) use($app) {
                $filesystem = FileStroge::disk('local');

                $path = Arr::get($configs, 'file.path', $app->getResourcePath() . 'sessions/');
                return new FileSessionHandler($filesystem, $path);
            }
        );

        $session->extend(
            'cache',
            function () use ($app){
                return $app->make('cache');
            }
        );


        $this->instance(
            'session',
            $session
        );


        $this->singleton(Stroge::class, function () use ($app) {
            $driver = Config::get('stroge.session.driver');

            return $app->make('session')->driver($driver);
        }
        );
    }
}
