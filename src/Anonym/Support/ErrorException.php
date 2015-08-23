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

/**
 * Class ErrorException
 * @package Anonym\Support
 */
class ErrorException
{

    /**
     * the code of error
     *
     * @var int
     */
    private $code;

    /**
     * the message of error
     *
     * @var string
     */
    private $message;

    /**
     * the file of error
     *
     * @var int
     */
    private $file;

    /**
     * the line of error
     *
     * @var int
     */
    private $line;


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

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return ErrorException
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ErrorException
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param int $file
     * @return ErrorException
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param int $line
     * @return ErrorException
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
    }


}
