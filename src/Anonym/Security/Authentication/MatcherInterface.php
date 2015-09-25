<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security\Authentication;

    /**
     * Interface AuthenticationMatcherInterface
     * @package Anonym\Security
     */
    interface MatcherInterface
    {

        /**
         * Kontrolu yapar ve girişin yapılıp yapılmadığını kontrol eder
         *
         * @return mixed
         */
        public function match();
    }


