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
    use Redis;
    /**
     * Yükleme işlemlerini yaparken Redis eklentisini kullanılır
     *
     * Class RedisReposity
     * @package Anonym\Components\Config
     */
    class RedisReposity extends Reposity
    {

        /**
         * Redis bağlantısı
         *
         * @var \Redis
         */
        private $redisObj;

        /**
         * Sınıfı başlatır
         *
         * @param array $cache
         * @param Redis $redis
         */
        public function __construct($cache = [], Redis $redis = null)
        {
            parent::__construct($cache);
            $this->setRedisObj($redis);
            $this->checkRedisExtension();
        }

        /**
         * Veriyi döndürür
         *
         * @param string $name
         * @return bool|mixed|string
         */
        public function get($name = ''){
            if(false === $var = $this->getRedisObj()->get($name)){
                $this->getRedisObj()->set($name, $var = parent::get($name));
            }

            return $var;
        }

        /**
         * @return \Redis
         */
        public function getRedisObj()
        {
            return $this->redisObj;
        }

        /**
         * @param \Redis $redisObj
         * @return RedisReposity
         */
        public function setRedisObj($redisObj)
        {
            $this->redisObj = $redisObj;

            return $this;
        }

        /**
         * Redis eklentisinin yüklü olup olmadığını kontrol eder
         *
         * @throws ExtensionNotLoadedException
         */
        private function checkRedisExtension()
        {
            if (!extension_loaded('redis')) {
                throw new ExtensionNotLoadedException(
                    sprintf(
                        '%s eklentiniz
                         yüklü olmadüı için %s sınıfını kullanamıyorsunuz',
                        'redis',
                        __CLASS__
                    )
                );
            }
        }
    }
