<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Components\Security\Authentication;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Database\Mode\Insert;

use Anonym\Components\Security\Security;

/**
 * Class Login
 * @package Anonym\Components\Security\Authentication
 */
class Login extends Authentication implements LoginInterface
{

    const LOGIN_LOGS_TABLE = 'logins';

    /**
     * Sınıfı başlatır ve tablo yapılandırmasını yapar
     *
     * @param Base $db
     * @param array $tables
     */
    public function __construct(Base $db, array $tables = [])
    {
        parent::__construct();
        $this->setDb($db);
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

        // login
        $login = $db->read(
            $table['table'],
            function (Read $mode) use (
                $userColumnName,
                $passColumnName,
                $username,
                $password,
                $getTables
            ) {
                return $mode->where(
                    [
                        [$userColumnName, '=', $username],
                        [$passColumnName, '=', $password],
                    ]
                )->select($getTables)->build();
            }
        );

        if ($login) {
            if ($login->rowCount()) {
                $login = (array)$login->fetch();

                // we will find user ip address
                // and add it to login informations
                $ip = Security::ip();

                // add client ip addres to login object
                $login['ip'] = $ip;
                $login = new LoginObject($login);
                $this->getSession()->set(static::USER_SESSION, $login);
                if ($remember) {
                    $this->getCookie()->set(static::USER_SESSION, serialize($login));
                }

                $this->getDb()->insert(self::LOGIN_LOGS_TABLE, function (Insert $insert) use ($ip, $username) {
                    return $insert->set([
                        'ip' => $ip,
                        'username' => $username
                    ]);
                });

                return $login;
            }
        }

        return false;
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
