<?php

    namespace Anonym\Adapter;

    /**
     *
     * Interface AdapterInterface
     *
     * @package Anonym\Adapter
     */

    interface AdapterInterface
    {

        /**
         * ismi getirir
         *
         * @return mixed
         */
        public function getName();

        /**
         * adepteri başlatır
         *
         * @return mixed
         */
        public function boot();
    }
