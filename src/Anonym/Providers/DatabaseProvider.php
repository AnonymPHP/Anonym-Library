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

use Anonym\Components\Database\Base;
use Anonym\Bootstrap\ServiceProvider;

/**
 * Class DatabaseProvider
 * @package Anonym\Providers
 */
class DatabaseProvider extends ServiceProvider
{
    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $this->singleton(
            'database.base',
            function () {
                $configs = Config::get('database');
                $connection = $configs['connection'];
                $connectionConfigs = Arr::get($configs['connections'], $connection, []);
                return new Base($connectionConfigs);
            }
        );
    }
}
