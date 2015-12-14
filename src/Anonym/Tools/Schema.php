<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Tools;

use Anonym\Database\Database;
use Exception;
use Anonym\Database\Base;

/**
 * Class Schema
 * @package Anonym\Tools
 */
class Schema
{

    /**
     * Bağlantı sağlayıcısını tutar
     *
     * @var \PDO|\mysqli|null
     */
    private static $connection;


    /**
     * Sınıfı başlatır
     *
     */
    public function __construct(Database $base)
    {

        static::setConnection($base->getBase()->getConnection());

    }

    /**
     * Tablo oluşturur ve işler
     * @param string $tableName
     * @param callable $callback
     * @return bool|\mysqli_result|\PDOStatement
     * @throws Exception
     */
    public function create($tableName = '', callable $callback)
    {

        $table = (new Table())->create($tableName);
        $response = $callback($table);

        if ($response instanceof TableInterface) {
            $string = $response->fetch();

            Blueprint::setCommand([]);
            return static::getConnection()->query($string);

        } else {
            throw new Exception('%s %s den dönen veri bir TableInterface değil');
        }
    }

    /**
     * $tableName'e girilen tabloyu siler
     *
     * @param string $tableName
     * @return bool|\mysqli_result|\PDOStatement
     */
    public function drop($tableName = '')
    {
        $query = $this->table->drop($tableName);
        return $this->connection->query($query);

    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param Table $table
     * @return Schema
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Bağlantı verisini döndürür
     *
     * @return \mysqli|null|\PDO
     */
    public static function getConnection()
    {
        return self::$connection;
    }

    /**
     * @param \mysqli|null|\PDO $connection
     */
    public static function setConnection($connection)
    {
        self::$connection = $connection;
    }

}
