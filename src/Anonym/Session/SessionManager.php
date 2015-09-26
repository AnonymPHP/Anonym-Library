<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Session;

use Anonym\Cookie\Cookie;
use Anonym\Crypt\Crypter;

use Anonym\Support\Arr;
use Closure;

/**
 * Class SessionManager
 * @package Anonym\Session
 */
class SessionManager
{

    /**
     * the list of session drivers
     *
     * @var array
     */
    protected $drivers = [

    ];

    /**
     * the list of session callbacks
     *
     * @var array
     */
    protected $extends;


    /**
     * the all configs
     *
     * @var array
     */
    protected $configs;

    /**
     * the instance of cryper
     *
     * @var AnonymCrypt
     */
    private $crypt;

    /**
     * create a new instance
     *
     * @param array $configs
     */
    public function __construct(array $configs = [], Crypter $crypt = null)
    {
        $this->setConfigs($configs);
        $this->crypt = $crypt;
    }

    /**
     * extend a new driver
     *
     * @param string $name
     * @param Closure $closure
     * @return $this
     */
    public function extend($name = '', Closure $closure)
    {
        $this->extends[$name] = $closure;

        return $this;
    }

    /**
     * create driver
     *
     * @param string $driver
     * @throws DriverNotFoundException
     * @return Stroge
     */
    public function driver($driver = '')
    {
        if (isset($this->drivers[$driver]) || isset($this->extends[$driver])) {
            $driver = $this->buildDriver($driver);

            return $this->initalizeDriver($driver);
        } else {
            throw new DriverNotFoundException(sprintf('%s driver is not found', $driver));
        }
    }


    /**
     * @param \SessionHandlerInterface $handler
     * @return EncryptedStroge|Stroge
     */
    private function initalizeDriver($handler)
    {
        if (Arr::get($this->configs, 'encrypt', false) === true) {
            return new EncryptedStroge($this->configs, $handler, $this->crypt);
        } else {
            return new Stroge($this->configs, $handler, $this->crypt);
        }
    }

    /**
     * @param string $name
     * @param string $class
     * @return mixed
     */
    private function buildDriver($name)
    {
        $instanceCallback = $this->createCallbackName($name);

        if (method_exists($this, $instanceCallback)) {
            return $this->$instanceCallback();
        } elseif (isset($this->extends[$name])) {
            $callback = $this->extends[$name];

            return $callback($this->configs);
        }
    }

    /**
     * create driver installer method name
     *
     * @param string $name
     * @return string
     */
    private function createCallbackName($name)
    {
        return "create".ucfirst($name)."Driver";
    }


    /**
     * @return array
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @param array $drivers
     * @return SessionManager
     */
    public function setDrivers($drivers)
    {
        $this->drivers = $drivers;

        return $this;
    }

    /**
     * @return array
     */
    public function getCreators()
    {
        return $this->creators;
    }

    /**
     * @param array $creators
     * @return SessionManager
     */
    public function setCreators($creators)
    {
        $this->creators = $creators;

        return $this;
    }


    /**
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @param array $configs
     * @return SessionManager
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;

        return $this;
    }
}
