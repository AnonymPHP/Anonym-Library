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
     * Class ConnectionFirewall
     * @package Anonym\Security
     */
    class ConnectionFirewall extends FirewallChecker implements FirewallCheckerInterface
    {

        /**
         * Kontrol İşlemini yapar
         *
         * @return bool
         */
        public function handle(){
          return $this->defaultChecker();
        }
    }
