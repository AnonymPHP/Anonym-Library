<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Crypt;

    /**
     * Class SecurityKeyGenerator
     * @package Anonym\Components\Crypt
     */
    class SecurityKeyGenerator implements SecurityKeyGeneratorInterface
    {

        /**
         * Özel güvenlik anahtarını oluşturur
         *
         * @return string
         */
        public function create()
        {
            $ip = $_SERVER['REMOTE_ADDR'];
            $len = strlen($ip);
            $letters = [];
            for ($i = 'a', $j = 1; $j <= 26; $i++, $j++) {
                $letters[$j] = $i;
            }
            $bas = substr($ip, 0, 2);
            $con = $letters[$len];
            $son = substr($ip, $len - 1, 1);
            $int = strval($len).$son;
            $con2 = $letters[$int];
            $serverIP = $_SERVER['SERVER_ADDR'];
            $message = $son . $serverIP . $con . $con2 . $ip . $bas;
            return md5($message);
        }

        /**
         * create a random string
         *
         * @param string $prefix
         * @return string
         */
        public function random($prefix = ''){
            $key = $prefix.$this->create().strval(rand(strlen($_SERVER['REMOTE_ADDR']), rand(111,2222)));
            $uniqid = uniqid($key);
            return md5($uniqid);
        }
    }
