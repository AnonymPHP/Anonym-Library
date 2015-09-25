<?php
/**
 *  AnonymFramework Connection Manager Trait, veritabanı baağlantısını başlatır ve sonlandırılması
 *  ması bu trait de gerçekleşir
 *
 * @package  Anonym\Components\Database\Traits;
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Components\Database\Traits;

use PDO;
use mysqli;
/**
 * Class ConnectionManager
 * @package Anonym\Components\Database\Traits
 */
trait ConnectionManager
{

    /**
     * the instance of mysql database driver
     *
     * @var PDO|mysqli
     */
    private $connection;

    /**
     * store the connected table name
     *
     * @var string
     */
    private $connectedTable;

    /**
     * close the connection
     */
    public function close()
    {

        $this->connection = null;
    }

    /**
     * register the connected table
     *
     * @param string $table the name of table
     * @return $this
     */
    public function connect($table)
    {
        $this->connectedTable = $table;
        return $this;
    }

    /**
     * get the selected table
     *
     * @return string the name of connected table
     */
    public function getTable()
    {

        return $this->connectedTable;
    }

    /**
     * get the instance of database driver
     *
     * @return PDO|mysqli
     */
    public function getConnection()
    {

        return $this->connection;
    }
}
