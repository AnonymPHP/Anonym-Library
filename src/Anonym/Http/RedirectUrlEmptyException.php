<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\HttpClient;
    use Exception;

    /**
     * Class RedirectUrlEmptyException
     * @package Anonym\HttpClient
     */
    class RedirectUrlEmptyException extends Exception
    {

        /**
         * Sınıfı başlatır ve mesajı gönderir
         *
         * @param string $message
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }
