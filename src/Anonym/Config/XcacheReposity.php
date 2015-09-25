<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Config;
    use Anonym\Components\Config\Reposity;


    /**
     * Class XcacheReposity
     * @package Anonym\Components\Config
     */
    class XcacheReposity extends Reposity
    {

        /**
         * Sınıfı başlatır
         *
         * @param array $cache
         */
        public function __construct($cache = [])
        {
            parent::__construct($cache);
            $this->checkXcacheExtension();
        }

        /**
         * Veriyi döndürür
         *
         * @param string $name
         * @return bool|mixed|string
         */
        public function get($name = ''){
            if(false === $var = xcache_get($name)){
                xcache_set($name, $var = parent::get($name));
            }

            return $var;
        }
        /**
         * Xcache eklentisinin yüklü olup olmadığını kontrol eder
         *
         * @throws ExtensionNotLoadedException
         */
        private function checkXcacheExtension()
        {
            if (!extension_loaded('xcache')) {
                throw new ExtensionNotLoadedException(
                    sprintf(
                        '%s eklentiniz
                         yüklü olmadüı için %s sınıfını kullanamıyorsunuz',
                        'xcache',
                        __CLASS__
                    )
                );
            }
        }
    }

