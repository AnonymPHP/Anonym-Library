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


use Anonym\Bootstrap\Container;
use Anonym\Components\Database\Base;
use Anonym\Facades\Config;
use Anonym\Support\Arr;

/**
 *
 * Class DatabaseConstructor
 * @package Anonym\Constructors
 */
class DatabaseConstructor
{
    use Container;

    /**
     *  register the database base
     */
    public function __construct()
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