<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Constructors;

use Anonym\Application\ServiceProvider;
use Anonym\Database\Base;
use Anonym\Database\Database;
use Anonym\Facades\App;
use Anonym\Facades\Config;
use Anonym\Support\Arr;

/**
 *
 * Class DatabaseConstructor
 * @package Anonym\Constructors
 */
class DatabaseConstructor extends ServiceProvider
{

    /**
     *  register the database base
     *
     */
    public function register()
    {

        $app = $this->app;

        if (true === $this->app['config']->get('database.autostart')) {

            $configs = Config::get('database');
            $connection = $configs['connection'];
            $connectionConfigs = Arr::get($configs['connections'], $connection, []);

            $base = new Base($connectionConfigs, $app);
            Database::setDatabaseApplication($base);

            $this->singleton(
                'database.base',
                function () {
                    return new Database();
                }
            );

            $this->singleton(Base::class, function () {
                return App::make('database.base');
            });

            Database::setDatabaseApplication($base);

        }
    }
}
