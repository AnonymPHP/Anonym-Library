<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;
use Anonym\Database\Base;
use Anonym\Database\Tongue\MysqlTongue;

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
        list($host, $username, $password, $dbname, $charset) = $this->getParametersNeeded($configs);
        return $this->connect($host, $username, $password, $dbname, $charset, Base::TYPE_MYSQL);
    }

    /**
     * prepare the instance of tongue class
     *
     * @return mixed
     */
    protected function prepareTongueInstance()
    {
        $tongue = new MysqlTongue();

        $this->tongue = $tongue;
    }
}
