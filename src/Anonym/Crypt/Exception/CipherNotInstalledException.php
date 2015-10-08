<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Crypt\Exception;
use Exception;

class CipherNotInstalledException extends Exception
{

    /**
     * create an instance and throw the exception
     *
     * @param string $message
     */
    public function __construct($message){
        $this->message = $message;
    }

}
