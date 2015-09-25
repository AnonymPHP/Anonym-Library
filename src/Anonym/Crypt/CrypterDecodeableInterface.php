<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\\Crypt;

    /**
     * Interface CrypterDecodeableInterface
     * @package Anonym\\Crypt
     */
    interface CrypterDecodeableInterface
    {

        /**
         * Şifrelenmiş metni çözer
         *
         * @param string $value
         * @return string
         */
        public function decode($value = '');

    }
