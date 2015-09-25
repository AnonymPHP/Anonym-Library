<?php

namespace Anonym\Components\Database\Managers;

use Anonym\Components\Database\Exceptions\FetchException;
use Anonym\Components\Database\Exceptions\QueryException;
use Anonym\Components\Database\Helpers\Pagination;
use mysqli_stmt;
use PDO;
use PDOStatement;
use Anonym\Components\Database\Base;
use mysqli;

/**
 * Class BuildManager
 * @package Anonym\Components\Database\Builders
 */
class BuildManager
{

    /**
     * Seçilen tabloyu tutar
     *
     * @var string
     */
    private $table;

    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * Query metnini tutar
     *
     * @var string
     */
    private $query;


    /**
     * Gönderilecek parametreleri tutar
     *
     * @var array
     */
    private $params = [];

    /**
     * Base Ataması yapar
     *
     * @param Base $base
     */
    public function __construct($base)
    {

        $this->connection = $base;
    }


    /**
     * Query Sorgusunu atar
     *
     * @param string $query
     */
    public function setQuery($query)
    {

        $this->query = $query;
    }

    /**
     * parametreleri atar
     *
     * @param array $params
     */
    public function setParams($params = [])
    {

        $this->params = $params;
    }


    /**
     * execute the query
     *
     * @param $query bool
     * @throws QueryException
     * @return PDOStatement|mysql_stmt|bool success on PDOStatement or mysql_stmt, if failure the query return false
     */
    public function run($query = false, $exception = true)
    {

        if (true === $query) {
            return $this->resolveQuery($this->query);
        }

        list($prepare, $resolved) = $this->resolvePreparedStatement($this->query, $this->params);

        if (false === $resolved) {
            if (true === $exception) {
                $this->resolveQueryException();
            }
        }

        return $prepare;
    }

    /**
     * throw the query exception
     *
     * @throws QueryException
     */
    private function resolveQueryException()
    {
        if ($this->getConnection() instanceof PDO) {
            $message = isset($this->connection->errorInfo()['message']) ? $this->getConnection()->errorInfo()['message'] : 'Something Went Wrong!';
        } elseif ($this->getConnection() instanceof mysqli) {
            $message = $this->getConnection()->error;
        }

        throw new QueryException($message);
    }

    /**
     * resolve the query
     *
     * @param string $query
     * @param array $parameters
     * @return true or false
     */
    private function resolvePreparedStatement($query = '', array $parameters = [])
    {

        // the instance of database connection
        $connection = $this->getConnection();
        $prepare = $connection->prepare($query);

        if ($prepare instanceof PDOStatement) {
            $resolved = $this->resolvePdoPreparedStatement($prepare, $parameters);
        } elseif ($prepare instanceof mysqli_stmt) {
            $resolved = $this->resolveMysqliPreparedStatement($prepare, $parameters);
        }

        return [$prepare, $resolved];
    }

    /**
     * resolve the pdo prepared statement
     *
     *
     * @param PDOStatement $prepare
     * @param array $parameters
     * @return bool
     */
    private function resolvePdoPreparedStatement(PDOStatement $prepare, array $parameters = [])
    {
        return $prepare->execute($parameters);
    }

    /**
     * resolve the mysql prepared statement
     *
     * @param mysqli_stmt $prepare
     * @param array $parameters
     * @return bool
     */
    private function resolveMysqliPreparedStatement(mysqli_stmt $prepare, array $parameters = [])
    {
        $s = "";
        foreach ($parameters as $param) {

            if (is_string($param)) {
                $s .= "s";
            } elseif (is_integer($param)) {
                $s .= "i";
            }
        }

        if (count($parameters) < 1) {
            $paramArray = [];
        } else {
            $paramArray = array_merge([$s], $parameters);
        }

        call_user_func_array([$prepare, 'bind_param'], $this->refValues($paramArray));
        return $prepare->execute();
    }

    /**
     * run the query
     *
     * @param string $query
     * @return PDOStatement|mysql_stmt|bool success on PDOStatement or mysql_stmt, if failure the query return false
     */
    private function resolveQuery($query)
    {
        return $this->getConnection()->query($query);
    }

    /**
     *
     *
     * @param $arr
     * @return array
     */
    private function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = [];
            foreach ($arr as $key => $value) {
                $refs[$key] = &$arr[$key];
            }

            return $refs;
        }

        return $arr;
    }

    /**
     * @param bool|false $fetchAll
     * @return array|mixed|object|\stdClass
     * @throws FetchException
     */
    public function fetch($fetchAll = false)
    {

        $query = $this->run(false, true);

        if ($query instanceof PDOStatement) {

            if ($fetchAll) {
                return $query->fetchAll();
            } else {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } elseif ($query instanceof mysqli_stmt) {

            $query = $query->get_result();
            if ($fetchAll) {
                return $query->fetch_all();
            } else {
                return $query->fetch_object();
            }
        } else {

            throw new FetchException(sprintf('Girdiğiniz veri tipi geçerli bir query değil. Tip:%s', gettype($query)));
        }
    }

    /**
     * Tüm işlemleri döndürür
     *
     * @return array|mixed|object|\stdClass
     * @throws \Exception
     */

    public function fetchAll()
    {

        return $this->fetch(true);
    }

    /**
     * Eşleşen içerik sayısını döndürür
     *
     * @return int
     */
    public function rowCount()
    {

        $query = $this->run(false, false);

        if ($query instanceof PDOStatement) {
            return $query->rowCount();
        } elseif ($query instanceof mysqli_stmt) {
            $query = $query->get_result();

            return $query->num_rows;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return BuildManager
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     * @return BuildManager
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }


}
