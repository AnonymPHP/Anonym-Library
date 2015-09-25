<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security;

    /**
     * Interface KeyGeneratorInterface
     * @package Anonym\Security
     */
    interface KeyGeneratorInterface
    {

        /**
         * Güvenlik kodunu oluşturur
         *
         * @return string
         */
        public function generate();
    }
