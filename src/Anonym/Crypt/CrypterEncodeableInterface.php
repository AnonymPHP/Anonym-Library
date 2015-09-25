<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Crypt;

    /**
     * Interface CrypterInterface
     * @package Anonym\Crypt
     */
    interface CrypterEncodeableInterface
    {

        /**
         * Veriyi şifreler
         *
         * @param string $value
         * @return string
         */
        public function encode($value = '');
    }
