<?php
    /**
     *  Bu sınıf AnonymFramework ' un bir parçasıdır.
     *  İmage vs dosyalarda yol'u oluşturmak için kullanılır.
     *
     * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
     */

    namespace Anonym\Assets;
    use Anonym\Assets\AssetInterface;
    /**
     * Class UrlPackpage
     * @package Anonym\Assets
     */
    class UrlPackpage
    {

        /**
         * Dİğer bir yöneticiyi tutar
         *
         *  @var AssetInterface
         */
        private $manager;

        /**
         * Url 'i tutar
         *
         * @var
         */
        private $url;

        /**
         * Sınıfı başlatır
         *
         * @param string $url
         * @param AssetInterface|null $manager
         */

        public function __construct($url = '', AssetInterface $manager = null)
        {

            $this->setManager($manager);
            $this->setUrlString($url);
        }

        /**
         * Manager'i döndürür
         *
         * @return AssetInterface
         */
        public function getManager()
        {

            return $this->manager;
        }

        /**
         * Url 'i oluşturucak ana yönetici
         *
         * @param AssetInterface $manager
         * @return $this
         */
        public function setManager(AssetInterface $manager = null)
        {

            $this->manager = $manager;

            return $this;
        }

        /**
         * url ataması yapar
         *
         * @return string
         */
        public function setUrlString($url = '')
        {

            $this->url = $url;

            return $this;
        }

        /**
         * Atanan url' i döndürür
         *
         * @return string
         */
        public function getUrlString()
        {
            return $this->url;
        }

        /**
         * Url'i oluşturur
         *
         * @param string $file
         * @return mixed
         */
        public function getUrl($file = '')
        {

            $version = $this->manager->getVersion();
            $pattern = $this->manager->getPattern();

            /** Search Params
             *  %f => $file
             *  %v => $version
             */

            $f = str_replace('%f', $file, $pattern);
            $v = str_replace('%v', $version, $f);

            return $this->getUrlString() . $v;
        }
    }
