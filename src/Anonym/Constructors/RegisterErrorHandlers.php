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

use Anonym\Log\Logger;
use Anonym\Support\Handler;
use Anonym\Bootstrap\Bootstrap;

class RegisterErrorHandlers
{

    /**
     * the instance of error, exception handler
     *
     * @var Handler
     */
    private $handler;

    /**
     * create a new instance and register handlers
     *
     * @param Bootstrap $app
     */
    public function __construct(Bootstrap $app){
        $this->handler = $app->make(Handler::class);

        $this->registerErrorHandler();
        $this->registerExceptionHandler();

        App::singleton('error.logger', function(){
            return new Logger();
        });
    }


    /**
     *  register the error handler
     */
    protected function registerErrorHandler(){
        set_error_handler([$this->handler, 'handleErrors']);
    }

    /**
     *  register the exception handler
     */
    protected function registerExceptionHandler(){
        set_exception_handler([$this->handler, 'handleExceptions']);
    }
}