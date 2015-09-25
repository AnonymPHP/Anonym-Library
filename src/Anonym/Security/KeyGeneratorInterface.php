<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security;

    /**
     * Interface KeyGeneratorInterface
     * @package Anonym\Components\Security
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
