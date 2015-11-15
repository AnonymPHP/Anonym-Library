<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;

use Anonym\Support\Arr;

/**
 * Class MysqlBridge
 * @package Anonym\Database\Bridge
 */
class MysqlBridge extends Bridge
{

    /**
     * the function for open bridge
     *
     * @return mixed
     */
    public function open()
    {
        $configs = $this->configurations;

        $host = Arr::get($configs, 'host', 'localhost');
        $username = Arr::get($configs, 'username', '');
        $password  = Arr::get($configs, 'password', '');

    }
}
