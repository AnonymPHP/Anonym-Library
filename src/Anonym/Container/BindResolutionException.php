<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Container;
use Exception;

/**
 * Class BindResolutionException
 * @package Anonym\Bootstrap
 */
class BindResolutionException extends Exception
{

    /**
     * throw the message
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
