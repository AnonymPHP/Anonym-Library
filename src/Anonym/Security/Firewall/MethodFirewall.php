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
     * Class MethodFirewall
     * @package Anonym\Security
     */
    class MethodFirewall extends FirewallChecker implements FirewallCheckerInterface
    {

        /**
         * Kontrol işlemini gerçekleştirir
         *
         * @return bool
         */
        public function handle(){
            return $this->defaultChecker();
        }
    }
