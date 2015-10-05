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


use Anonym\Application\Application;
use Anonym\Application\ServiceProvider;
use Anonym\Http\Request;
use Anonym\Security\Validation;

/**
 * Class RequestConstructor
 * @package Anonym\Constructors
 */
class RequestConstructor extends ServiceProvider
{

    /**
     * add the request  and response to container
     *
     */
    public function register()
    {

        $app->singleton('validation', function(){

            return new Validation();
        });

        // register the request
        $app->bind(
            'http.request',
            function () use ($app) {

                return new Request($app->make('validation'));
            },
            true
        );

        // register the response
        $app->bind(
            'http.response',
            function () use ($app) {
                return $app->make('http.request')->getResponse();
            },
            true
        );
    }
}
