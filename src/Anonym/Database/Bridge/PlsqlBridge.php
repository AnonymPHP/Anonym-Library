<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;

use Anonym\Database\Tongue\PlsqlTongue;
use Illuminate\Support\Arr;

/**
 * Class PlsqlBridge
 * @package Anonym\Database\Bridge
 */
class PlsqlBridge extends Bridge
{

    /**
     * prepare the instance of tongue class
     *
     * @return mixed
     */
    protected function prepareTongueInstance()
    {
        $tongue = new PlsqlTongue();

        $this->tongue = $tongue;
    }

    /**
     * the function for open bridge
     *
     * @throws BridgeException
     * @throws ConnectionException
     * @return mixed
     */
    public function open()
    {

        $configs = $this->configurations;
        $host = Arr::get($configs, 'host', 'localhost');
        $username = Arr::get($configs, 'username', '');
        $password = Arr::get($configs, 'password', '');
        $dbname = Arr::get($configs, 'db', '');
        $charset = Arr::get($configs, 'charset', 'utf8');
        $port = Arr::get($configs, 'port', 1521);

        if (!$this->driverIsExists('oci')) {
            throw new BridgeException(sprintf('%s pdo driver is not installed, please try that after install it ', 'oci'));
        }

        try {
            $this->db = new PDO("oci:dbname=//$host:$port/$dbname", $username, $password);
            $this->db->exec("SET NAMES '$charset'; SET CHARSET '$charset'");
        } catch (\PDOException $e) {
            throw new ConnectionException(sprintf('PDO threw that exception message : %s', $e->getMessage()));
        }

        return $this->db;
    }
}
