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

class AliasNotFoundException extends Exception
{

    public function __construct($message = '')
    {
        $this->message = $message;
    }
}