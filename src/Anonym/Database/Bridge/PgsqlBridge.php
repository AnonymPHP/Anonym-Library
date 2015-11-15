<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;
use Anonym\Database\Base;
use Anonym\Database\Tongue\PgsqlTongue;

/**
 * Class PgsqlBridge
 * @package Anonym\Database\Bridge
 */
class PgsqlBridge extends Bridge
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
        return $this->connect($host, $username, $password, $dbname, $charset, Base::TYPE_PGSQL);
    }

    /**
     * prepare the instance of tongue class
     *
     * @return mixed
     */
    protected function prepareTongueInstance()
    {
        $tongue = new PgsqlTongue();

        $this->tongue = $tongue;
    }
}
