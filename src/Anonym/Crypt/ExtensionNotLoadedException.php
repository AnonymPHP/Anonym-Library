<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Crypt;
    use Exception;

    /**
     * Class ExtensionNotLoadedException
     * @package Anonym\Components\Crypt
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
