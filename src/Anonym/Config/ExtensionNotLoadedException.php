<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Config;
    use Exception;

    /**
     * Class ExtensionNotLoadedException
     * @package Anonym\Components\Config
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
