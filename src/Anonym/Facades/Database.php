<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Facades;


use Anonym\Support\Arr;
use Anonym\Components\Database\Base;

class Database
{

    /**
     * the instance of database base
     *
     * @var Base
     */
    private $base;

    /**
     *  create a new instance and set the base
     *
     */
    public function __construct()
    {
        $configs = Config::get('database');
        $connection = $configs['connection'];
        $connectionConfigs = Arr::get($configs['connections'], $connection, []);

        $this->base = new Base($connectionConfigs);
    }

    /**
     * dynamic method calling in base
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args = [])
    {
        return call_user_func_array([$this->base, $name], $args);
    }

}
