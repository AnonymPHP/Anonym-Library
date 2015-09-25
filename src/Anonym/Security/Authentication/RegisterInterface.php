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
     * Interface RegisterInterface
     * @package Anonym\Components\Security\Authentication
     */
    interface RegisterInterface
    {

        /**
         * Kullanıcı kayıt işlemini yapar
         *
         * @param array $post
         * @return mixed
         */
        public function register(array $post = []);
    }
