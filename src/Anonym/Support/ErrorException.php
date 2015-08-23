<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Support;

use Exception;

class ErrorException extends Exception
{

    /**
     * throw the exception
     *
     * @param int $code
     * @param string $messsage
     * @param int $file
     * @param int $line
     */
    public function __construct($code, $messsage, $file, $line)
    {
        $this->code = $code;
        $this->message = $messsage;
        $this->file = $file;
        $this->line = $line;
    }
}
