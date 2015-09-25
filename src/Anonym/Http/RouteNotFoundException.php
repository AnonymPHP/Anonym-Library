<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Http;
use Exception;

/**
 * Class RouteNotFoundException
 * @package Anonym\Http
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
