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


use Anonym\Support\ErrorListener;
use Anonym\Support\ErrorException;

/**
 * Class HandlerConstructor
 * @package Anonym\Constructors
 */
class HandlerConstructor
{

    /**
     *  create a new instance and set the error handler
     *
     */
    public function __construct()
    {

        // set the error handler
        set_error_handler(function($code, $messsage, $file, $line){
            $listener = new ErrorListener(new ErrorException($code, $messsage, $file, $line));
            $listener->send();

        });

        // set the exception handler
        set_exception_handler(function($exception){
            $listen = new ErrorListener($exception);
            $listen->send();
        });
    }

}