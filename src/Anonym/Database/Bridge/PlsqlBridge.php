<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;
use Illuminate\Support\Arr;

/**
 * Class PlsqlBridge
 * @package Anonym\Database\Bridge
 */
class PlsqlBridge extends Bridge
{

    /**
     * prepare the instance of tongue class
     *
     * @return mixed
     */
    protected function prepareTongueInstance()
    {

    }

    /**
     * the function for open bridge
     *
     * @return mixed
     */
    public function open()
    {

        $configs = $this->configurations;
        $host = Arr::get($configs, 'host', 'localhost');
        $username = Arr::get($configs, 'username', '');
        $password  = Arr::get($configs, 'password', '');
        $dbname = Arr::get($configs, 'db', '');
        $charset = Arr::get($configs, 'charset', 'utf8');
        $port = Arr::get($configs, 'port', 1521);

        $database = "
    (DESCRIPTION =
      (ADDRESS_LIST =
        (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port))
      )
    (CONNECT_DATA =
      (SERVICE_NAME = orcl)
    )
   )";


        $db = new PDO('oci:dbname='.$database, $username, $password);
    }
}
