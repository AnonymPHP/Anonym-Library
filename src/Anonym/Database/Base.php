<?php

/**
 *  AnonymFramework Veritabanı ana sınıfı
 *  # builderler ve alt sınıflarla ilişikiyi kuracak
 *
 * @package Anonym\Database
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database;

use Anonym\Database\Mode\Advanced;
use Anonym\Database\Traits\Where;
use Illuminate\Container\Container;
use Anonym\Support\Arr;
use Anonym\Database\Exceptions\BridgeException;
use Anonym\Database\Bridge\PlsqlBridge;
use Anonym\Database\Bridge\PgsqlBridge;
use Anonym\Database\Bridge\MysqlBridge;
use Anonym\Database\Mode\Delete;
use Anonym\Database\Mode\Read;
use Anonym\Database\Mode\Update;
use Anonym\Database\Mode\Insert;
use Anonym\Database\Traits\ConnectionManager;
use Anonym\Database\Traits\ModeManager;
use Anonym\Database\Bridge\Bridge;
use PDO;
use Closure;

/**
 * Class Base
 * @package Anonym\Database
 */
class Base
{
    use ModeManager, Where;

    const TYPE_PGSQL = 'pgsql';
    const TYPE_MYSQL = 'mysql';
    const TYPE_MSSQL = 'mssql';
    const TYPE_PLSQL = 'plsql';


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
        self::TYPE_MYSQL => MysqlBridge::class,
        self::TYPE_PGSQL => PgsqlBridge::class,
        self::TYPE_PLSQL => PlsqlBridge::class
    ];
    /**
     * the instance of Laravel Container
     *
     * @var Container
     */
    private static $container;

    /**
     * the instance of PDO
     *
     * @var PDO
     */
    protected $db;

    /**
     * returns the query builder
     *
     * @var QueryBuilder
     */
    private static $queryBuilder;

    /**
     * returns the attributes
     *
     * @var array
     */
    protected $attributes;


    /**
     * create a new instance and use the configs
     *
     * @param array $configs
     * @param Container $container
     * @throws \Anonym\Database\Exceptions\ConnectionException
     */
    public function __construct(array $configs = [], Container $container = null)
    {
        static::$container = $container;
        $this->openConnection($configs);
        static::$queryBuilder = new QueryBuilder($this);
    }

    /**
     * open the connection  between bridge to sql driver
     *
     * @param array $options
     * @throws BridgeException
     */
    private function openConnection(array $options)
    {
        $bridge = Arr::get($options, 'bridge', Base::TYPE_MYSQL);

        if (Arr::has($this->bridges, $bridge)) {
            $bridge = Arr::get($this->bridges, $bridge);
            $this->bridge = $instance = static::$container->make($bridge, [$options]);

            if ($instance instanceof Bridge) {
                $this->db = $instance->open();
            }
        } else {
            throw new BridgeException(sprintf('%s bridge is not exists', $bridge));
        }
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
    public function getConnection()
    {
        return $this->db;
    }

    /**
     * register the connection table with given table name
     *
     * @param string $table
     */
    protected function connect($table)
    {
        $this->connectedTable = $table;
    }

}
