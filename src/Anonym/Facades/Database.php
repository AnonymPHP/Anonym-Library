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


use Anonym\Patterns\Singleton;
use Anonym\Components\Database\Base;

class Database
{

    /**
     * the instance of database base
     *
     * @var Base
     */
    public $base;

    /**
     *  create a new instance and set the base
     *
     */
    public function __construct()
    {
        $this->base = Singleton::bind('database.base');
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

    /**
     * dynamic method calling in base
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($name, $args = [])
    {
        $app = new static();
        return call_user_func_array([$app->base, $name], $args);
    }


}
