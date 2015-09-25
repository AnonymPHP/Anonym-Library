<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Database\Exceptions;
use Exception;

/**
 * Class ConnectionException
 * @package Anonym\Components\Database\Exceptions
 */
class ConnectionException extends Exception
{

    /**
     * throw the exception
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}
