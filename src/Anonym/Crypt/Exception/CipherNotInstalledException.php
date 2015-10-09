<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Crypt\Exception;
use Exception;

/**
 * Class CipherNotInstalledException
 * @package Anonym\Components\Crypt\Exception
 */
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
