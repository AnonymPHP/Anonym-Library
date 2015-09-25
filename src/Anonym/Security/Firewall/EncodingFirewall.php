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
     * Class EncodingFirewall
     * @package Anonym\Security
     */
    class EncodingFirewall extends FirewallChecker implements FirewallCheckerInterface
    {

        /**
         * Sınamayı gerçekleştirir
         *
         * @return bool
         */
        public function handle(){
            return $this->defaultChecker();
        }
    }
