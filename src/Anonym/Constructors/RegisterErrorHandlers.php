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
        $handler = $app->make(Handler::class);

        $this->registerErrorHandler();
        $this->registerExceptionHandler();
    }

}
