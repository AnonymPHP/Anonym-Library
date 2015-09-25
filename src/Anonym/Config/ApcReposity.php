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
     * Class ApcReposity
     * @package Anonym\Components\Config
     */
    class ApcReposity extends Reposity
    {

        /**
         * Sınıfı başlatır
         *
         * @param array $cache
         */
        public function __construct($cache = [])
        {
            parent::__construct($cache);
            $this->checkApcExtension();
        }

        /**
         * Veriyi döndürür
         *
         * @param string $name
         * @return bool|mixed|string
         */
        public function get($name = ''){
            if(false === $var = apc_fetch($name)){
                apc_store($name, $var = parent::get($name));
            }

            return $var;
        }

        /**
         * Apc eklentisinin yüklü olup olmadığını kontrol eder
         *
         * @throws ExtensionNotLoadedException
         */
        private function checkApcExtension()
        {
            if (!function_exists('apc_store')) {
                throw new ExtensionNotLoadedException(
                    sprintf(
                        '%s eklentiniz
                         yüklü olmadüı için %s sınıfını kullanamıyorsunuz',
                        'apc',
                        __CLASS__
                    )
                );
            }
        }
    }
