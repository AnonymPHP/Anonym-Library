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
use Anonym\Database\Bridge\Bridge;
use Anonym\Database\Exceptions\ConnectionException;
use Anonym\Database\Bridge\MysqlBridge;
use Anonym\Support\Arr;
use PDO;
use PDOException;
use mysqli;

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
     * @throws ConnectionException
     */
    public function __construct($options = [])
    {
        $bridge = Arr::get($options, 'bridge', Base::TYPE_MYSQL);

        if (Arr::has($options, $bridge)) {
            $instance= $this->container->make($bridge, [$options]);

            if ($instance instanceof Bridge) {
                $this->db = $instance->open();
            }
        }else{
            throw new BridgeException(sprintf('%s bridge is not exists', $bridge));
        }

        $host = isset($options['host']) ? $options['host'] : '';
        $database = isset($options['db']) ? $options['db'] : '';
        $username = isset($options['username']) ? $options['username'] : '';
        $password = isset($options['password']) ? $options['password'] : '';
        $charset = isset($options['charset']) ? $options['charset'] : 'utf8';

        if (!isset($options['driver'])) {
            $driver = 'pdo';
        } else {
            $driver = $options['driver'];
        }

        if (!isset($options['type'])) {
            $type = 'mysql';
        } else {
            $type = $options['type'];
        }

        $this->type = $type;

        switch ($driver) {
            case 'pdo':
                try {

                    $db = new PDO("$type:host=$host;dbname=$database", $username, $password);
                    $this->db = $db;
                } catch (PDOException $e) {

                    throw new ConnectionException($e->getMessage());
                }

                break;
            case 'mysqli':

                $db = new mysqli($host, $username, $password, $database);

                if ($db->connect_errno > 0) {
                    throw new ConnectionException('Bağlantı işlemi başarısız [' . $db->connect_error . ']');
                }

                $this->db = $db;
                break;
        }

        $this->db->query(sprintf("SET CHARACTER SET %s", $charset));
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
