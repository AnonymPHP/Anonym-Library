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
     * Class Base64Crypt
     * @package Anonym\Components\Crypt
     */
    class Base64Crypt implements CrypterEncodeableInterface, CrypterDecodeableInterface
    {
        /**
         * Metni şifreler
         *
         * @param string $value
         * @return string
         */
        public function encode($value = ''){
            return base64_encode($value);
        }

        /**
         * Şifrelenmiş metni çözer
         *
         * @param string $value
         * @return string
         */
        public function decode($value = ''){
            return base64_decode($value);
        }
    }
