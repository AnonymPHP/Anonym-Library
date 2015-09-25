<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security\Authentication;
    use Anonym\Security\Authentication\AuthenticationMatcherInterface;
    use Anonym\Security\Authentication\Authentication;

    /**
     * Session ile kullanıcının giriş yapıp yapmadığını kontrol eder
     *
     * Class AuthenticationSessionMatcher
     * @package Anonym\Security\Exception
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
