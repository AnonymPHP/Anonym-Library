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
     * @var string
     */
    private $line;


    /**
     * the error code of error
     *
     * @var string
     */
    private $code;

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
     * @return string
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param string $line
     * @return ErrorJar
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ErrorJar
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }




}