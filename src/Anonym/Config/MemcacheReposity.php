<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Config;

    use Anonym\Config\Reposity;
    use Memcache;

    /**
     * Yükleme işlemlerini yaparken Redis eklentisini kullanılır
     *
     * Class MemcacheReposity
     * @package Anonym\Config
     */
    class MemcacheReposity extends Reposity
    {

        /**
         * Redis bağlantısı
         *
         * @var Memcache
         */
        private $memcacheObj;

        /**
         * Sınıfı başlatır
         *
         * @param array $cache
         * @param Memcache $memcache
         */
        public function __construct($cache = [], Memcache $memcache = null)
        {
            parent::__construct($cache);
            $this->setMemcacheObj($memcache);
            $this->checkMemcacheExtension();
        }

        /**
         * Veriyi döndürür
         *
         * @param string $name
         * @return bool|mixed|string
         */
        public function get($name = ''){
            if(false === $var = $this->getMemcacheObj()->get($name)){
                $this->getMemcacheObj()->set($name, $var = parent::get($name));
            }

            return $var;
        }

        /**
         * Redis eklentisinin yüklü olup olmadığını kontrol eder
         *
         * @throws ExtensionNotLoadedException
         */
        private function checkMemcacheExtension()
        {
            if (!extension_loaded('memcache')) {
                throw new ExtensionNotLoadedException(
                    sprintf(
                        '%s eklentiniz
                         yüklü olmadüı için %s sınıfını kullanamıyorsunuz',
                        'memcache',
                        __CLASS__
                    )
                );
            }
        }

        /**
         * @return \Redis
         */
        public function getMemcacheObj()
        {
            return $this->memcacheObj;
        }

        /**
         * @param \Redis $memcacheObj
         * @return MemcacheReposity
         */
        public function setMemcacheObj($memcacheObj)
        {
            $this->memcacheObj = $memcacheObj;

            return $this;
        }
    }
