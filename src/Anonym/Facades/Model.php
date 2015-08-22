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

class Model
{

    /**
     * the instance of database base
     *
     * @var Base
     */
    private $base;

    public function __construct()
    {
        $configs = Config::get('database');
        $connection = $configs['connection'];
        $connectionConfigs = Arr::get($configs['connections'], $connection, []);



    }
}
