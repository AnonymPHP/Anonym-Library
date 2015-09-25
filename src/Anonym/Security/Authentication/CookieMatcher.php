<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;

    /**
     * Class AuthenticationCookieMatcher
     * @package Anonym\Components\Security\Authentication
     */
    class CookieMatcher extends Authentication implements  AuthenticationMatcherInterface
    {

        /**
         * Kontrol işlemini yapar
         *
         * @return bool
         */
        public function match(){
            $cookie = $this->getCookie();
            $key = static::USER_SESSION;

            if($cookie->has($key)){

                if($value = unserialize($cookie->get($key)) instanceof AuthenticationLoginObject){
                    return $value;
                }
            }else{
                return false;
            }

        }
    }
