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


use Anonym\Support\ErrogBag;
use Anonym\Support\ErrorJar;

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
            ErrogBag::addError(new ErrorJar($messsage, $file, $line, $code));
        });

        set_exception_handler(function($exception){
           ErrogBag::
        });
    }

}