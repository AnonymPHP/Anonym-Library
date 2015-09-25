<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Route;

use Exception;

/**
 * the class of route match exception
 *
 * Class RouteMatchException
 * @package Anonym\Route
 */
class RouteMatchException extends Exception
{

    /**
     * Throw a exception
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
