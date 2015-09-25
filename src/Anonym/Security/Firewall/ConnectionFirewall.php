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
     * Class ConnectionFirewall
     * @package Anonym\Components\Security
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
