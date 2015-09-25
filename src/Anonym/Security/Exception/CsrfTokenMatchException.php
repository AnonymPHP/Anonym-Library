<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Exception;
    use Exception;

    /**
     * Class CsrfTokenMatchException
     * @package Anonym\Components\Security
     */
    class CsrfTokenMatchException extends Exception
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
