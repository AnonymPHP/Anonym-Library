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


use Anonym\Bootstrap\Bootstrap;
use Anonym\Components\HttpClient\Request;

class RequestConstructor
{

    /**
     * add the request  and response to container
     *
     * @param Bootstrap $app
     */
    public function __construct(Bootstrap $app)
    {

        // register the request
        $app->bind(
            'http.request',
            function () {
                return new Request();
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
