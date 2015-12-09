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
    use ModeManager;

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
     * As değerini tutar
     *
     * @var mixed
     */
    private $as;

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
    private function openConnection(array $options)
    {
        $bridge = Arr::get($options, 'bridge', Base::TYPE_MYSQL);

        if (Arr::has($this->bridges, $bridge)) {
            $bridge = Arr::get($this->bridges, $bridge);
            $this->bridge = $instance = $this->container->make($bridge, [$options]);

            if ($instance instanceof Bridge) {
                $this->db = $instance->open();
            }
        } else {
            throw new BridgeException(sprintf('%s bridge is not exists', $bridge));
        }
    }


    /**
     * Select sorgusu olu�turur
     *
     * @param string $select
     * @return $this
     */
    public function select($select = null)
    {

        $this->datas['select'] = $select;

        return $this;
    }



    /**
     * İçeriği temizler
     *
     * @return static
     */
    private function cleanThis()
    {

        return new static($this->getBase());
    }

    /**
     * Order Sorgusu oluşturur
     *
     * @param string $order
     * @param string $type
     * @return \Anonym\Database\Mode\Read
     */
    public function order($order, $type = 'DESC')
    {

        $this->datas['order'] =  [$order, $type];
        return $this;
    }


    /**
     * Join komutu ekler
     *
     * @param array $join
     * @return $this
     */
    public function join($join = [])
    {
        $this->datas['join'] = $join;
        return $this;
    }

    /**
     * @param int $page
     * @return \Anonym\Database\Mode\Read
     */
    public function page($page)
    {
        $this->page = $page;
        $limit = Config::get('database.pagination');
        $limit = $limit['limit'];
        $baslangic = ($page - 1) * ($limit);
        $bitis = $page * $limit;

        return $this->limit([$baslangic, $bitis]);
    }

    /**
     * Group By sorgusu ekler
     *
     * @param string $group
     * @return \Anonym\Database\Mode\Read
     */
    public function group($group)
    {

        $this->datas['group'] = $group;

        return $this;
    }


    /**
     * İç içe bir sorgu oluşturur
     *
     * @param string $as
     * @param mixed $select
     * @return  \Anonym\Database\Mode\Read
     */
    public function create($as, $select)
    {

        $this->setAs($as);

        return $this->select($select);
    }

    /**
     * Limit sorgusu oluşturur
     *
     * @param string $limit
     * @return \Anonym\Database\Mode\Read
     */
    public function limit($limit)
    {

        $this->datas['limit'] = $limit;

        return $this;
    }



    /**
     * @param string $as
     * @return \Anonym\Database\Mode\Read
     */
    public function setAs($as)
    {
        $this->as = $as;
        return $this;
    }


    /**
     * Select de kullanılacak as değerini döndürür
     *
     * @return string
     */
    public function getAs()
    {

        return $this->as;
    }

    /**
     * Etkilenen elaman sayısını döndürür
     *
     * @return int
     */

    public function rowCount()
    {
        return $this->build()->rowCount();
    }

    /**
     * İçeriği tekil veya çokul olarak döndürür
     *
     * @param bool $fetchAll
     * @return array|mixed|object|\stdClass
     * @throws \Exception
     */
    public function fetch($fetchAll = false)
    {

        return $this->build()->fetch($fetchAll);
    }

    /**
     * Tüm İçeriği Döndürür
     *
     * @return array|mixed|object|\stdClass
     */
    public function fetchAll()
    {

        return $this->fetch(true);
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
