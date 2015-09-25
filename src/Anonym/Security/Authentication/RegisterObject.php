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
     * Class AuthenticationRegisterObject
     * @package Anonym\Components\Security\Authentication
     */
    class RegisterObject
    {

        /**
         * Kullanıcı bilgilerini depolar
         *
         * @var array
         */
        private $user;


        /**
         * Tablo bilgilerini depolar
         *
         * @var array
         */
        private $tables;

        /**
         * Sınıfı başlatır
         *
         * @param array $user
         */
        public function __construct(array $user = [], $tables = [])
        {
            $this->setUser($user);
            $this->setTables($tables);
        }

        /**
         * @return array
         */
        public function getUser()
        {
            return $this->user;
        }

        /**
         * @param array $user
         * @return AuthenticationRegisterObject
         */
        public function setUser($user)
        {
            $this->user = $user;
            return $this;
        }

        /**
         * @return array
         */
        public function getTables()
        {
            return $this->tables;
        }

        /**
         * @param array $tables
         * @return AuthenticationRegisterObject
         */
        public function setTables($tables)
        {
            $this->tables = $tables;

            return $this;
        }



        /**
         *Giriş işlemini yapar
         *
         * @return AuthenticationLoginObject|bool
         */
        public function login(){

        }
    }
