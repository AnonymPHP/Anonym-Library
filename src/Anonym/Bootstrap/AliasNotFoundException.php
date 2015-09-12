<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Bootstrap;

use Exception;

/**
 * Class AliasNotFoundException
 * @package Anonym\Bootstrap
 */
class AliasNotFoundException extends Exception
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
