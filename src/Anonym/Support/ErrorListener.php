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


use Anonym\Bootstrap\Container;

class ErrorListener extends Container
{

    /**
     * the instance of any exception
     *
     * @var \Exception
     */
    private $exception;

    /**
     * create a new instance and register the exception
     *
     * @param \Exception $exception
     */
    public function __construct($exception)
    {
        $this->setException($exception);
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param \Exception $exception
     * @return ErrorListener
     */
    public function setException($exception)
    {
        $this->exception = $exception;
        return $this;
    }

    public function send()
    {

    }
}

