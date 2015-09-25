<?php

/**
 *  AnonymFramework Veritabanı ana sınıfı
 *  # builderler ve alt sınıflarla ilişikiyi kuracak
 *
 * @package Anonym\Components\Database
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Components\Database;

use Anonym\Components\Database\Mode\Delete;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Database\Mode\Update;
use Anonym\Components\Database\Mode\Insert;
use Anonym\Components\Database\Traits\ConnectionManager;
use Anonym\Components\Database\Traits\ModeManager;
use PDO;
use mysqli;
/**
 * Class Base
 * @package Anonym\Components\Database
 */
class Base extends Starter
{

    use ConnectionManager,
        ModeManager;

    /**
     * create a new instance and use the configs
     *
     * @param array $configs
     * @throws \Anonym\Components\Database\Exceptions\ConnectionException
     */
    public function __construct(array $configs = [])
    {

        parent::__construct($configs);
        $this->connection = $this->getDb();

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

    /**
     * return the last query error
     *
     * @return string
     */
    public function errorInfo(){
        if ($this->getConnection() instanceof PDO) {
            $message = isset($this->connection->errorInfo()['message']) ? $this->getConnection()->errorInfo()['message'] : 'Something Went Wrong!';
        } elseif ($this->getConnection() instanceof mysqli) {
            $message = $this->getConnection()->error;
        }

        return $message;
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
}
