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
     * Interface SecurityKeyGeneratorInterface
     * @package Anonym\Components\Crypt
     */
    interface SecurityKeyGeneratorInterface
    {

        /**
         * Özel Şifreyi oluşturur
         *
         * @return string
         */
        public function create();
    }
