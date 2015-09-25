<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

       namespace Anonym\Security\Firewall;
       use Anonym\Security\Firewall\FirewallCheckerInterface;
    /**
     * Class UserAgentFirewall
     * @package Anonym\Security
     */
    class UserAgentFirewall extends FirewallChecker implements FirewallCheckerInterface
    {

        /**
         * Karşılaştırma yapar
         *
         * @return bool
         */
        public function handle()
        {
            return $this->defaultChecker();
        }
    }
