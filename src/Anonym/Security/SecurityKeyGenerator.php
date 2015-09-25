<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security;
    use Anonym\Crypt\SecurityKeyGenerator as ParentGenerator;

    /**
     * Class SecurityKeyGenerator
     * @package Anonym\Security
     */
    class SecurityKeyGenerator extends ParentGenerator implements KeyGeneratorInterface
    {
        /**
         * Güvenlik kodunu oluşturur
         *
         * @return string
         */
        public function generate(){
            return $this->create();
        }
    }
