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
use HttpException;
use ErrorException;


/**
 * Class Handler
 * @package Anonym\Support
 */
class Handler
{

    /**
     * convert to errors to exceptions
     *
     * @param int $code
     * @param string $message
     * @param string $file
     * @param int $line
     * @throws ErrorException
     */
    public function handleErrors($code, $message, $file, $line){

        // throw a new error.
        throw new ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param Exception $e
     * @return mixed
     */
    public function handleExceptions(Exception $e){

    }

    protected function isHttpException(Exception $e){
        return $e instanceof HttpException;
    }
}
