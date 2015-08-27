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


use Anonym\Facades\Config;
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

        if (true === Config::get('error.handler.errors.enabled')) {
            // set the error handler

            $switch = Config::get('error.handler.errors.switch');
            set_error_handler(
                function ($code, $messsage, $file, $line) use ($switch) {
                    $listener = new ErrorListener(new ErrorException($code, $messsage, $file, $line));
                    $listener->send();

                }
            );
        }


        if (true === Config::get('error.handler.exceptions')) {
            // set the exception handler
            set_exception_handler(
                function ($exception) {
                    $listen = new ErrorListener($exception);
                    $listen->send();
                }
            );
        }

    }

}