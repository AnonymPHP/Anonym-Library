<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

       namespace Anonym\Components\Security\Firewall;
       use Anonym\Components\Security\Firewall\FirewallCheckerInterface;
    /**
     * Class EncodingFirewall
     * @package Anonym\Components\Security
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
