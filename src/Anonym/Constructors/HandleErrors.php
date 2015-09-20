<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Constructors;

use HttpException;
use Anonym\Facades\Config;
use Anonym\Bootstrap\Bootstrap;
use Symfony\Component\Debug\ExceptionHandler;

class HandleErrors
{

    /**
     * @param Bootstrap $app
     */
    public function __construct(Bootstrap $app){

    }

    public function exceptionHandler(){
        $debug = new ExceptionHandler(Config::get('app.debug'));
    }
    /**
     * Determine if the given exception is an HTTP exception.
     *
     * @param  \Exception  $e
     * @return bool
     */
    protected function isHttpException(Exception $e)
    {
        return $e instanceof HttpException;
    }
}