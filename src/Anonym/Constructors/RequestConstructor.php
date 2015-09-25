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
use Anonym\Http\Request;
use Anonym\Security\Validation;

class RequestConstructor
{

    /**
     * add the request  and response to container
     *
     * @param Bootstrap $app
     */
    public function __construct(Bootstrap $app)
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
