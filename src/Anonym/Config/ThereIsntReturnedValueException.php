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
     * Class ThereIsntReturnedValueException
     * @package Anonym\Components\Config
     */
    class ThereIsntReturnedValueException extends Exception
    {

        /**
         * Sınıfı başlatır ve istisnayı ayarlar
         *
         * @param string $message
         */
        public function __construct($message = ''){
            $this->message = $message;
        }
    }
