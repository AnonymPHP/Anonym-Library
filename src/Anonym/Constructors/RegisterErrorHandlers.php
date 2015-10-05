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

use Anonym\Application\ServiceProvider;
use Anonym\Support\Handler;
use Anonym\Application\Application;

/**
 * Class RegisterErrorHandlers
 * @package Anonym\Constructors
 */
class RegisterErrorHandlers extends ServiceProvider
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
     * @param Application $app
     */
    public function __construct(Application $app){
        $this->handler = $app->make(Handler::class);
        $this->handler->setDebug($app->getGeneral()['debug'])->setLog($app->getGeneral()['log'])->fire();
        $this->registerErrorHandler();
        $this->registerExceptionHandler();

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
