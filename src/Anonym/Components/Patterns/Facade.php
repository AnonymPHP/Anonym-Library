<?php

    /**
     *  AnonymFramework Facade Desing Pattern
     *
     * @package Anonym\Patterns
     * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
     */

    namespace Anonym\Patterns;

    use Exception;

    class Facade
    {

        public static $instance = [];

        /**
         * @return mixed
         *  Classı almak için kullanılan method
         */
        protected static function getFacedeRoot()
        {

            if ($root = static::resolveFacede()) {
                return $root;
            }
        }

        /**
         * @return mixed
         * @throws \Exception
         *   Sınıfı Kontrol eder
         */
        protected static function resolveFacede()
        {

            return static::resolveFacedeClassName(static::getFacadeClass());
        }

        /**
         * @throws \Exception
         *  Alt sınıflarda sınıfın ismini döndürmesi için kullanılır
         */
        protected static function getFacadeClass()
        {

            throw new Exception("Facede kendi kendini cagiramaz");
        }

        /**
         * @param $name
         *  Sınıfın olup olmadığını kontrol ediyor
         */
        protected static function resolveFacedeClassName($name)
        {

            if (is_object($name)) {
                return $name;
            } elseif (is_string($name) && !isset(static::$instance[$name])) {
                $instance = new $name();
                static::$instance[$name] = $instance;
            }

            if (isset(static::$instance[$name])) {
                return static::$instance[$name];
            } else {
                return $name;
            }
        }


        /**
         * Dönen sınıfdan istediğimiz methodu static olarak çağırmaya yarar
         *
         * @param $method
         * @param $parametres
         * @return mixed
         */
        public static function __callStatic($method, $parametres)
        {
            return call_user_func_array([static::getFacedeRoot(), $method], $parametres);
        }

        /**
         * Facade sınıflarda dinamik çağrımı destekler
         *
         * @param $method
         * @param $parametres
         * @return mixed
         */

        public function __call($method, $parametres)
        {
            return call_user_func_array([static::getFacedeRoot(), $method], $parametres);
        }
    }
