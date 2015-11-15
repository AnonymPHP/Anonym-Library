<?php

/**
 *  AnonymFramework Veritabanı ana sınıfı
 *  # builderler ve alt sınıflarla ilişikiyi kuracak
 *
 * @package Anonym\Database
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database;

use Illuminate\Container\Container;
use Anonym\Database\Mode\Delete;
use Anonym\Database\Mode\Read;
use Anonym\Database\Mode\Update;
use Anonym\Database\Mode\Insert;
use Anonym\Database\Traits\ConnectionManager;
use Anonym\Database\Traits\ModeManager;
use PDO;
use mysqli;

/**
 * Class Base
 * @package Anonym\Database
 */
class Base extends Starter
{
    use ModeManager;

    const TYPE_PGSQL = 'pgsql';
    const TYPE_MYSQL = 'mysql';
    const TYPE_MSSQL = 'mssql';

    /**
     * the instance of Laravel Container
     *
     * @var Container
     */
    public $container;

    /**
     * the instance of PDO
     *
     * @var PDO
     */
    protected $db;



    /**
     * the name of connecting table
     *
     * @var string
     */
    protected $connectedTable;

    /**
     * create a new instance and use the configs
     *
     * @param array $configs
     * @throws \Anonym\Database\Exceptions\ConnectionException
     */
    public function __construct(array $configs = [], Container $container = null)
    {
        parent::__construct($configs);
        $this->container = $container;
    }


    /**
     * Select işlemlerinde kullanılır
     *
     * @param string $table
     * @param callable $callable
     * @return mixed
     * @access public
     */
    public function read($table, callable $callable = null)
    {

        $this->connect($table);
        $read = new Read($this);

        return $callable($read);
    }

    /**
     * Update işlemlerinde kullanılır
     *
     * @param string $table
     * @param callable $callable
     * @return mixed
     */
    public function update($table, callable $callable = null)
    {

        $this->connect($table);
        $update = new Update($this);

        return $callable($update);
    }

    /**
     * Insert şlemlerinde kullanılır
     *
     * @param string $table
     * @param callable $callable
     * @return mixed
     */
    public function insert($table, callable $callable = null)
    {

        $this->connect($table);
        $insert = new Insert($this);

        return $callable($insert);
    }

    /**
     * Delete delete işlemlerinde kullanılır
     *
     * @param string $table
     * @param callable $callable
     * @return mixed
     */
    public function delete($table, callable $callable = null)
    {
        $this->connect($table);
        $delete = new Delete($this);

        return $callable($delete);
    }

    /**
     * @return mixed
     */
    public function getConnectedTable()
    {
        return $this->connectedTable;
    }

    /**
     * @param mixed $connectedTable
     * @return ConnectionManager
     */
    public function setConnectedTable($connectedTable)
    {
        $this->connectedTable = $connectedTable;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModes()
    {
        return $this->modes;
    }

    /**
     * @param mixed $modes
     *
     * @return ModeManager
     */
    public function setModes($modes)
    {
        $this->modes = $modes;

        return $this;
    }

    /**
     * Veritabanının içeriğini döndürür.
     *
     * @return $this
     */
    public function getInstance()
    {
        return $this;
    }

    /**
     * return the last query error
     *
     * @return string
     */
    public function errorInfo()
    {
        $message = isset($this->bridge->db->errorInfo()['message']) ? $this->getConnection()->errorInfo()['message'] : 'Something Went Wrong!';
        return $message;
    }

    /**
     * Dinamik method çağrımı
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args = [])
    {
        if ($this->isMode($method)) {
            $return = $this->callMode($method, $args);
        } else {

            $return = call_user_func_array([$this->getConnection(), $method], $args);
        }

        return $return;
    }


}
