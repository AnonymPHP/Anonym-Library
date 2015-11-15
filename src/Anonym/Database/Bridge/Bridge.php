<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;

use Anonym\Database\Exceptions\BridgeException;
use Anonym\Database\Exceptions\ConnectionException;
use Anonym\Support\Arr;

/**
 * Class Bridge
 * @package Anonym\Database\Bridge
 */
abstract class Bridge
{

    /**
     * the instance of pdo connection
     *
     * @var PDO
     */
    public $db;

    /**
     * an array type for connectione configuration values
     *
     *
     * @var array
     */
    protected $configurations;

    /**
     * the instance of tongue class
     *
     * @var Tongue
     */
    protected $tongue;

    /**
     * the constructor of Bridge .
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;

        $this->prepareTongueInstance();
    }


    /**
     * prepare the instance of tongue class
     *
     * @return mixed
     */
    abstract protected function prepareTongueInstance();

    /**
     * the abstract function for open bridge
     *
     * @return mixed
     */
    abstract public function open();

    /**
     * connecting to the database with given host, username, password, bridge variables
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $db
     * @param string $charset
     * @param string $bridge
     * @throws BridgeException
     * @throws ConnectionException
     * @return mixed
     */
    protected function connect($host, $username, $password, $db, $charset, $bridge)
    {

        if (!$this->driverIsExists($bridge)) {
            throw new BridgeException(sprintf('%s pdo driver is not installed, please try that after install it '));
        }
        try {
            $this->db = new \PDO("$bridge:host=$host;dbname=$db", $username, $password);
            $this->db->exec("SET NAMES '$charset'; SET CHARSET '$charset'");

            return $this->db;
        } catch (\PDOException $e) {
            throw new ConnectionException(sprintf('PDO threw that exception message : %s', $e->getMessage()));
        }
    }

    /**
     * determine pdo driver is already installed or not.
     *
     * @param string $driver
     * @return bool if driver is already installed returns true, is not returns false
     */
    protected function driverIsExists($driver)
    {
        $drivers = \PDO::getAvailableDrivers();

        return Arr::has($drivers, $driver);
    }

    /**
     * find and return the parameters are we needed them
     *
     * @param array $configs
     * @return array
     */
    protected function getParametersNeeded(array $configs){
        $host = Arr::get($configs, 'host', 'localhost');
        $username = Arr::get($configs, 'username', '');
        $password  = Arr::get($configs, 'password', '');
        $dbname = Arr::get($configs, 'db', '');
        $charset = Arr::get($configs, 'charset', 'utf8');

        return [$host, $username, $password, $dbname, $charset];
    }
}
