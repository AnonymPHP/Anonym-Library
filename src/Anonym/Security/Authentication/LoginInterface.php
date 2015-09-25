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
     * Interface LoginInterface
     * @package Anonym\Components\Security\Authentication
     */
    interface LoginInterface
    {
        /**
         * Kullanıcı girişi yaptırılır
         * $remember true girilirse cookie e atanır veriler.
         *
         * @param string $username
         * @param string $password
         * @param bool|false $remember
         * @return bool
         */
        public function login($username = '', $password = '', $remember = false);
    }
