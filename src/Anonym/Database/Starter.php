<?php

/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Database;
use Anonym\Components\Database\Exceptions\ConnectionException;
use PDO;
use PDOException;
use mysqli;

/**
 * Class Starter
 * @package Anonym\Components\Database
 */
class Starter
{

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
}
