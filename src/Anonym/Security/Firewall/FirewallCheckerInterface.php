<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

       namespace Anonym\Components\Security\Firewall;

    /**
     * Interface FirewallInterface
     * @package Anonym\Components\Security
     */
    interface FirewallCheckerInterface
    {

        /**
         * Yakalama işlemini ve güvenlik önlemlerini yapar
         *
         * @return bool
         */
        public function handle();
    }
