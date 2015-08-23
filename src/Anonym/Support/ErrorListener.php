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


class ErrorListener
{

    /**
     * the instance of any exception
     *
     * @var Exception
     */
    private $exception;

    public function __construct($exception)
    {

    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     * @return ErrorListener
     */
    public function setException($exception)
    {
        $this->exception = $exception;
        return $this;
    }




}
