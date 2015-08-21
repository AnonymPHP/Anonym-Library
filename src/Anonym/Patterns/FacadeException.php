<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Patterns;
use Exception;

/**
 * the exception of facade
 *
 * Class FacadeException
 * @package Anonym\Patterns
 */
class FacadeException extends Exception
{

    /**
     * throw the exception
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}
