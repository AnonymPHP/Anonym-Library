<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Application;
use Exception;

class HttpException extends Exception
{

    /**
     * the status code to response
     *
     * @var int
     */
    protected $statusCode;

    /**
     * the list of headers
     *
     * @var array
     */
    protected $headers;

    public function __construct($statusCode, $message, array $headers){
        $this->code = $statusCode;
        $this->statusCode = $statusCode;
        $this->headers= $headers;
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return HttpException
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return HttpException
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


}