<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;
use Anonym\Database\Exceptions\BridgeException;
use Anonym\Support\Arr;

/**
 * Class Bridge
 * @package Anonym\Database\Bridge
 */
abstract class Bridge
{

    /**
     * an array type for connectione configuration values
     *
     *
     * @var array
     */
    protected $configurations;

    /**
     * the constructor of Bridge .
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }

    /**
     * the abstract function for open bridge
     *
     * @return mixed
     */
    abstract public function open();

    /**
     * connecting to the database with given host, username, password, bridge variables
     *
     * @param string  $host
     * @param string $username
     * @param string $password
     * @param string $bridge
     * @throws BridgeException
     * @return mixed
     */
    protected function connect($host, $username, $password, $bridge){

        if (!$this->driverIsExists($bridge)) {
            throw new BridgeException(sprintf('%s pdo driver is not installed, please try that after install it '));
        }

    }

    /**
     * determine pdo driver is already installed or not.
     *
     * @param string $driver
     * @return bool if driver is already installed returns true, is not returns false
     */
    protected function driverIsExists($driver){
        $drivers = \PDO::getAvailableDrivers();

        return Arr::has($drivers, $driver);
    }
}
