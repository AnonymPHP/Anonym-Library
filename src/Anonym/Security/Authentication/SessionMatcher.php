<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;
    use Anonym\Components\Security\Authentication\AuthenticationMatcherInterface;
    use Anonym\Components\Security\Authentication\Authentication;

    /**
     * Session ile kullanıcının giriş yapıp yapmadığını kontrol eder
     *
     * Class AuthenticationSessionMatcher
     * @package Anonym\Components\Security\Exception
     */
    class SessionMatcher extends  Authentication implements  AuthenticationMatcherInterface
    {

        /**
         * Kullanıcının giriş yapıp yapmadığını session a bakarak kontrol eder
         *
         * @return bool|AuthenticationLoginObject
         */
        public function match(){

            $session = $this->getSession();
            $key = static::USER_SESSION;
            if($session->has($key)){

                if($value = $session->get($key) instanceof AuthenticationLoginObject){
                    return $value;
                }
            }else{
                return false;
            }
        }
    }
