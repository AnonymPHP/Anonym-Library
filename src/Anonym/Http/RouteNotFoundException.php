<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\HttpClient;
use Exception;

/**
 * Class RouteNotFoundException
 * @package Anonym\HttpClient
 */
class RouteNotFoundException extends Exception
{

    /**
     * create a new instance
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
