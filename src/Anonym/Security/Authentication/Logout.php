<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security\Authentication;

    use Anonym\Cookie\Cookie;
    use Anonym\Session\Session;

    /**
     * Class Logout
     * @package Anonym\Security\Authentication
     */
    class Logout extends Authentication
    {

        /**
         * Çıkış işlemini yapar
         *
         * @return bool
         */
        public function logout()
        {
            $cookie = new Cookie();
            $cookie->delete(static::USER_SESSION);
            $session = new Session();
            $session->delete(static::USER_SESSION);

            return true;
        }
    }
