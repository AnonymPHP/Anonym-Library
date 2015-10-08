<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Crypt;
    use Exception;
    use InvalidArgumentException;
    /**
     * Class AnonymCrypt
     * @package Anonym\Crypt
     */
    class AnonymCrypt implements CryptInterface
    {

        /**
         * the random key for security key
         *
         * @var string
         */
        protected  $applicationKey;


        /**
         * Sınıfı başlatır
         *
         * @throws Exception
         */
        public function __construct($applicationKey)
        {
            if (!function_exists('openssl_encrypt')) {
                throw new Exception('OpenSsl extension is must be installed on your server.');
            }


            $this->applicationKey = $applicationKey;
        }



    }
