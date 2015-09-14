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

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Security\Authentication\Login;

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
    private $table;
    /**
     * @var Base
     */
    private $base;

    /**
     * create a new instance and register base instance
     *
     * @param Base $base
     */
    public function __construct(Base $base)
    {

        $this->base = $base;
        $this->table = Login::LOGIN_LOGS_TABLE;
    }

    /**
     * get login logs with limit variable
     *
     * @param int $limit
     * @return mixed
     */
    public function getLoginsWithLimit($limit = 5){
        return $this->buildQuery($limit)->fetchAll();
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
     * @return mixed
     */
    public function getLast5Login()
    {
        return $this->getLoginsWithLimit();
    }
    /**
     * return all logins logs
     *
     * @return array
     */
    public function getAllLogins(){
        return $this->buildQuery()->fetchAll();
    }

    /**
     * clean all logs
     *
     * @return mixed
     */
    public function cleanLogs(){
        return $this->base->query(sprintf('TRUNCATE %s', $this->table));
    }
    /**
     * build database query
     *
     * @param null $limit
     * @return mixed
     */
    private function buildQuery($limit = null, $username = null)
    {

        $table = $this->table;

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
