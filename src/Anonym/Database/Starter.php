<?php

/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database;

use Anonym\Database\Exceptions\BridgeException;
use Anonym\Database\Bridge\MysqlBridge;
use Anonym\Database\Bridge\Bridge;
use Anonym\Support\Arr;
use PDOException;
use mysqli;
use PDO;

/**
 * Class Starter
 * @package Anonym\Database
 */
class Starter
{

    /**
     * @var string
     */
    protected $type;

    /**
     * store bridge names and their class names
     *
     * @var array
     */
    protected $bridges = [
      Base::TYPE_MYSQL =>  MysqlBridge::class
    ];

    /**
     * the instance of database driver
     *
     * @var mysqli|PDO
     */
    private $db;

    /**
     * create a new instance and install the driver
     *
     * @param array $options the options to db
     * @throws BridgeException
     */
    public function __construct($options = [])
    {
        $bridge = Arr::get($options, 'bridge', Base::TYPE_MYSQL);

        if (Arr::has($options, $bridge)) {
            $instance= $this->container->make($bridge, [$options]);

            if ($instance instanceof Bridge) {
                $this->db = $instance->open();
            }
        } else {
            throw new BridgeException(sprintf('%s bridge is not exists', $bridge));
        }
    }

    /**
     * return the registered database driver
     *
     * @return mysqli|PDO
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
