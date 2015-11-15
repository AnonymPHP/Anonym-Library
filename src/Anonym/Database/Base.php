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
use Anonym\Database\Bridge\Bridge;
use PDO;
use mysqli;

/**
 * Class Base
 * @package Anonym\Database
 */
class Base
{
    use ModeManager;

    const TYPE_PGSQL = 'pgsql';
    const TYPE_MYSQL = 'mysql';
    const TYPE_MSSQL = 'mssql';


    /**
     * the instance of bridge
     *
     * @var Bridge
     */
    public $bridge;

    /**
     * store bridge names and their class names
     *
     * @var array
     */
    protected $bridges = [
        self::TYPE_MYSQL =>  MysqlBridge::class
    ];
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
     * @param Container $container
     * @throws \Anonym\Database\Exceptions\ConnectionException
     */
    public function __construct(array $configs = [], Container $container = null)
    {
        $this->container = $container;


        $this->openConnection($configs);
    }

    /**
     * open the connection  between bridge to sql driver
     *
     * @param array $options
     * @throws BridgeException
     */
    private function openConnection(array $options){
        $bridge = Arr::get($options, 'bridge', Base::TYPE_MYSQL);

        if (Arr::has($options, $bridge)) {
            $this->bridge = $instance= $this->container->make($bridge, [$options]);

            if ($instance instanceof Bridge) {
                $this->db = $instance->open();
            }
        } else {
            throw new BridgeException(sprintf('%s bridge is not exists', $bridge));
        }
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
        $read = new Read($this,'read');

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
        $update = new Update($this, 'update');

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
        $insert = new Insert($this, 'insert');

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
        $delete = new Delete($this, 'delete');

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
     * return the instance of pdo connection
     *
     * @return PDO
     */
    public function getConnection(){
        return $this->db;
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
