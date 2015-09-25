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


use Anonym\Bootstrap\ServiceProvider;
use Anonym\Facades\ErrorBag;
use Anonym\Facades\View;

/**
 * Class ErrorbagServiceProvider
 * @package Anonym\Support
 */
class ErrorbagServiceProvider extends ServiceProvider
{

    /**
     *  register error composer
     */
    public function register(){
        View::composer('*', ErrorBag::getErrors());
    }

}
