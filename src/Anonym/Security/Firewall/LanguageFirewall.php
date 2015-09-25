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
     * Class LanguageFirewall
     * @package Anonym\Components\Security
     */
    class LanguageFirewall extends FirewallChecker implements FirewallCheckerInterface
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
