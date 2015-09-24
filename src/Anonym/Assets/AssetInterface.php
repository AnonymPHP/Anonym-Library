<?php

    /**
     * Bu ınterface PathPackpage, UrlPackpage gibi assets dosyalarında kullanılmak üzere tasarlanmıştır.
     * Interface AssetInterface

     */

    namespace Anonym\Assets;

    /**
     * Interface AssetInterface
     *
     * @package Anonym\Assets
     */

    interface AssetInterface
    {

        /**
         * Oluşturulan url'i döndürür
         *
         * @param string $file
         * @return mixed
         */

        public function getUrl($file = '');
    }
