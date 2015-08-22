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
 * the handler of error
 *
 * Class ErrorJar
 * @package Anonym\Support
 */
class ErrorJar
{

    /**
     * the message of error
     *
     * @var string
     */
    private $message;

    /**
     * the file name of error
     *
     * @var string
     */
    private $file;

    /**
     * the file line of error
     *
     * @var int
     */
    private $line;


    /**
     * the error code of error
     *
     * @var int
     */
    private $code;


    /**
     * create a new instance and set the parameters
     *
     * @param string $message
     * @param string $file
     * @param int $line
     * @param int $code
     */
    public function __construct($message, $file, $line, $code)
    {
        $this->setMessage($message);
        $this->setFile($file);
        $this->setLine($line);
        $this->setCode($code);

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
     * @return ErrorJar
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return ErrorJar
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
     * @return ErrorJar
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
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
     * @return ErrorJar
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}
