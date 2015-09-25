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
     * Class HttpResponseException
     * @package Anonym\HttpClient
     */
    class HttpResponseException extends Exception
    {

        /**
         * Sınıfı başlatır ve istisnayı oluşturur
         *
         * @param string $message
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }
