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
     * Class Md5Crypt
     * @package Anonym\Components\Crypt
     */
    class Md5Crypt implements CrypterEncodeableInterface
    {

        /**
         * Metni md5 ile şifreler
         *
         * @param string $value
         * @return string
         */
        public function encode($value = ''){
            return md5($value);
        }
    }
