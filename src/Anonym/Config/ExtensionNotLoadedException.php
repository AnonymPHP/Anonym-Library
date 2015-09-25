<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Config;
    use Exception;

    /**
     * Class ExtensionNotLoadedException
     * @package Anonym\Config
     */
    class ExtensionNotLoadedException extends Exception
    {

        /**
         * İstisnayı oluşturur
         *
         * @param string $message
         */
        public function __construct($message = ''){
            $this->message = $message;
        }
    }
