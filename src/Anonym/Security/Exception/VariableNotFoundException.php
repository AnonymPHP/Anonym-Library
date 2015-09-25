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
     * Class VariableNotFoundException
     * @package Anonym\Security\Exception
     */
    class VariableNotFoundException extends Exception
    {

        /**
         * İstisnayı oluşturur
         *
         * @param string $name
         */
        public function __construct($name = '')
        {
            $this->message = $name;
        }

    }
