<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Session;

use Exception;

/**
 * Class DriverNotFoundException
 * @package Anonym\Components\Session
 */
class DriverNotFoundException extends Exception
{

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
