<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Providers;


use Anonym\Facades\App;
use Anonym\Support\ErrorBag;
use Illuminate\Support\ServiceProvider;

class ErrorBagServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('errors.bag', function(){
           return new ErrorBag();
        });
    }
}
