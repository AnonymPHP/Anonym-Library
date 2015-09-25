<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Config;

    use Symfony\Component\Finder\Finder;
    use Symfony\Component\Finder\SplFileInfo;
    use Exception;

    /**
     * Class ConfigLoader
     * @package Anonym\Components\Config
     */
    class ConfigLoader
    {

        /**
         * Ayar dosyalarının bulunduğu konumu döndürür
         *
         * @var string
         */
        private $configPath = '';

        /**
         * Önbelleğe alınmış ayar dosyasını getirir
         *
         * @var string|null
         */
        private $cachedConfigPath = null;

        /**
         * Sınıfı başlatır ve gerekli atamaları yapar
         *
         * @param string $configPath
         * @param null $cachedConfigPath
         */
        public function __construct($configPath = '', $cachedConfigPath = null)
        {
            $this->setConfigPath($configPath);
            $this->setCachedConfigPath($cachedConfigPath);
        }

        /**
         *
         * Ayar Dosyalarını Yükler
         *
         * @return array
         */
        public function loadConfigs()
        {

            // ilk olarak kayıtlı bir önbellek dosyası varmı diye bakıyoruz

            $cached = $this->getCachedConfigPath();

            if(null !== $cached && file_exists($cached)){
                $items = require $cached;
            }else{
                $load = $this->loadConfigItems($this->getAllConfigFiles());

                $items = (is_array($load) && count($load) > 0) ? $load : [];
            }

            return $items ?: [];
        }

        /**
         * Dosyaları Yükler
         * @throws Exception
         * @param array $files
         * @return array
         */
        private function loadConfigItems(array $files = [])
        {
            $configs = [];
            foreach ($files as $name => $path) {
                if (file_exists($path)) {
                    $return = include $path;
                    if (is_array($return)) {
                        $configs[$name] = $return;
                    } else {
                        throw new ThereIsntReturnedValueException(
                            sprintf(
                                '%s ayar dosyasında herhangi bir değer döndürülmemiş
                                 veya yanlış ayar döndürüldü',
                                $path
                            )
                        );
                    }
                }
            }

            return $configs;
        }


        /**
         * Tüm Config Dosylarını döndürür
         * @return array
         */
        private function getAllConfigFiles()
        {
            $finded = Finder::create()->files()->name('*.php')->in($this->getConfigPath());
            $files = [];
            foreach ($finded as $find) {
                if ($find instanceof SplFileInfo) {
                    $files[explode('.', $find->getFilename())[0]] = $find->getRealPath();
                }
            }

            return $files;
        }

        /**
         * @return string
         */
        public function getConfigPath()
        {
            return $this->configPath;
        }

        /**
         * @param string $configPath
         * @return ConfigLoader
         */
        public function setConfigPath($configPath)
        {
            $this->configPath = $configPath;

            return $this;
        }

        /**
         * @return string
         */
        public function getCachedConfigPath()
        {
            return $this->cachedConfigPath;
        }

        /**
         * @param string $cachedConfigPath
         * @return ConfigLoader
         */
        public function setCachedConfigPath($cachedConfigPath)
        {
            $this->cachedConfigPath = $cachedConfigPath;

            return $this;
        }
    }
