<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Security\Authentication;

use Anonym\Database\Database;

use Anonym\Security\Security;

/**
 * Class Login
 * @package Anonym\Security\Authentication
 */
class Login extends Authentication implements LoginInterface
{

    const LOGIN_LOGS_TABLE = 'logins';

    /**
     * Sınıfı başlatır ve tablo yapılandırmasını yapar
     *
     * @param Database $db
     * @param array $tables
     */
    public function __construct(Database $db, array $tables = [])
    {
        parent::__construct();
        $this->setDb($db->table($tables['table']));
        $this->setTables($tables);
    }

    /**
     * Kullanıcı girişi yaptırılır
     * $remember true girilirse cookie e atanır veriler.
     *
     * @param string $username
     * @param string $password
     * @param bool|false $remember
     * @return bool|LoginObject
     */
    public function login($username = '', $password = '', $remember = false)
    {
        $db = $this->getDb();
        $table = $this->getTables();
        list($userColumnName, $passColumnName) = $table['login'];
        $getTables = $table['select'];

        $getTables[] = $table['authentication']['column'];

        $db->where([
            [$userColumnName, $username],
            [$passColumnName, $password]
        ]);

        if ($db->exists()) {
            $login = $db->first();

            // we will find user ip address
            // and add it to login information
            $ip = Security::ip();


            $login['ip'] = $ip;
            $login = new LoginObject($login);

            $this->getSession()->set(static::USER_SESSION, $login);
            if ($remember) {
                $this->getCookie()->set(static::USER_SESSION, serialize($login));
            }

            $db->insert([
                'ip' => $ip,
                'username' => $username
            ]);
        }


    }

    /**
     * Dinamik olarak method çağrımı
     *
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->getDb(), $method], $params);
    }

}
