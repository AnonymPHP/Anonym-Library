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
 * the exception of fetch
 *
 * Class FetchException
 * @package Anonym\Components\Database\Exceptions
 */
class FetchException extends Exception
{

    /**
     * throw the exception message
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
