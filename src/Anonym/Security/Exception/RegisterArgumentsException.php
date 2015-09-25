<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security\Exception;
    use Exception;

    /**
     * Class RegisterArgumentsException
     * @package Anonym\Security\Authentication
     */
    class RegisterArgumentsException extends Exception
    {

        /**
         * İstisnayı oluşturur
         *
         * @param string $message
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }

    }
