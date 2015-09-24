<?php
    /**
     *  Bu Sınıf AnonymFramework'de Asset Sınıfında Versiona dayalı işlemler yapmak için tasarlanmıştır
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     */
    namespace Anonym\Assets;

    /**
     * Class VersionPackpage
     *
     * @package Anonym\Assets
     */

    class VersionPackpage implements AssetInterface
    {

        /**
         * Assets dosyalarının öntanımlı yolunu tutar
         *
         * @var string
         */

        private $defaultPath = 'public/assets/';

        /**
         * Girilecek version değerini tutar
         *
         * @var string
         */
        private $version = '';

        /**
         * Değiştirelecek deseni tutar
         *
         * @var string
         */
        private $pattern = '';

        /**
         * Sınıfı başlatır ve version, paten ve path gibi değerleri atar
         *
         * @param string $version
         * @param string $pattern
         * @param string $defaultPath
         */

        public function __construct($version = '', $pattern = '%f?%v', $defaultPath = 'public/assets/')
        {
            $this->setPattern($pattern);
            $this->setVersion($version);
            $this->setDefaultPath($defaultPath);
        }

        /**
         * Asset klasörünün yolunu ayarlar
         *
         * @param string $path
         * @return $this
         */
        public function setDefaultPath($path = '')
        {
            $this->defaultPath = $path;
            return $this;
        }

        /**
         * Assets klasörünün yolunu döndürür
         *
         * @return string
         */
        public function getDefaultPath()
        {
            return $this->defaultPath;
        }

        /**
         * Version ataması yapar
         *
         * @param string $version
         * @return $this
         */
        public function setVersion($version = '')
        {
            $this->version = $version;

            return $this;
        }

        /**
         * Pattern ataması yapar
         *
         * @param string $pattern
         * @return $this
         */
        public function setPattern($pattern = '')
        {

            $this->pattern = $pattern;

            return $this;
        }

        /**
         * Versionu döndürür
         *
         * @return mixed
         */
        public function getVersion()
        {

            return $this->version;
        }

        /**
         * Pattern'i döndürür
         *
         * @return string
         */

        public function getPattern()
        {

            return $this->pattern;
        }

        /**
         * Url'i oluşturur
         *
         * @param string $file
         * @param string $prefix
         * @return mixed
         */
        public function getUrl($file = '', $prefix = '')
        {

            $version = $this->getVersion();
            $pattern = $this->getPattern();

            /** Search Params
             *  %f => $file
             *  %v => $version
             */

            $f = str_replace('%f', $file, $pattern);
            $v = str_replace('%v', $version, $f);

            return $this->getDefaultPath() . $prefix . $v;
        }
    }
