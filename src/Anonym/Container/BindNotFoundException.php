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
 * Class BindNotFoundException
 * @package Anonym\Bootstrap
 */
class BindNotFoundException extends Exception
{

    /**
     * throw the new exception
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}