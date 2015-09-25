<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Crypt;
    use Anonym\Facades\Config;

    /**
     * Class SecurityKeyGenerator
     * @package Anonym\Crypt
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

            if(null === $get = Config::get('general.app_key')){
                $get = 'AnonymFrameworkRandom'.$_SERVER['SERVER_ADDR'];
            }

            return md5($get);
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
