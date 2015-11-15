<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Exceptions;
use Exception;

/**
 * Class BridgeException
 * @package Anonym\Database\Exceptions
 */
class BridgeException extends Exception
{

    /**
     * throw the exception with given message
     *
     * the constructor of BridgeException .
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
