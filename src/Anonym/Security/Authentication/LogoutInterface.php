<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;

    /**
     * Interface LogoutInterface
     * @package Anonym\Components\Security\Authentication
     */
    interface LogoutInterface
    {
        /**
         * Çıkış işlemini yapar
         *
         * @return bool
         */
        public function logout();
    }

