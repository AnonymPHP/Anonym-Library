<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Auth;

use Anonym\Database\Database;
use Anonym\Security\Authentication\Login;

/**
 * Class LastLogins
 * @package Anonym\Auth
 */
class LastLogins
{

    /**
     * the name of table
     *
     * @var string
     */
    private $loginTable;


    /**
     * @var Database
     */
    private $base;

    /**
     * create a new instance and register base instance
     *
     * @param Database $base
     */
    public function __construct(Database $base)
    {
        $this->base = $base;
        $this->loginTable = Login::LOGIN_LOGS_TABLE;
    }

    /**
     * get login logs with limit variable
     *
     * @param int $limit
     * @param string $username
     * @return mixed
     */
    public function getLoginsWithLimit($limit = 5, $username = null){
        return $this->buildQuery($limit, $username)->fetchAll();
    }

    /**
     * get happened errors
     *
     * @return mixed
     */
    public function getErrorInfo(){
        return $this->base->errorInfo();
    }
    /**
     * return maded last 5 login proccess
     *
     * @param string $username
     * @return mixed
     */
    public function getLast5Login($username = null)
    {
        return $this->getLoginsWithLimit(5, $username);
    }
    /**
     * return all logins logs
     *
     * @param string $username
     * @return array
     */
    public function getAllLogins($username = null){
        return $this->buildQuery(null, $username)->fetchAll();
    }

    /**
     * clean all logs
     *
     * @return mixed
     */
    public function cleanLogs(){
        return $this->base->query(sprintf('TRUNCATE %s', $this->loginTable));
    }
    /**
     * build database query
     *
     *
     * @param null $limit
     * @param null $username
     * @return mixed
     */
    private function buildQuery($limit = null, $username = null)
    {

        $table = $this->loginTable;

        return $this->base->read($table, function (Read $read) use ($limit, $username) {
            $read->select('*');

            if (null !== $limit) {
                $read->limit($limit);
            }

            if (null !== $username) {
                $read->where([[
                    'username','=', $username
                ]]);
            }

            return $read->build();
        });
    }
}
