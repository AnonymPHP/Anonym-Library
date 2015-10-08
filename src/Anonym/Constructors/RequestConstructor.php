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

        $this->singleton(
            'validation',
            function () {

                return new Validation();
            }
        );

        $app = &$this->app;
        // register the request
        $this->singleton(
            'http.request',
            function () use (&$app) {


                $request = new Request($app['validation']);
                $request->header('X-FRAMEWORK-NAME', $app->getName());
                $request->header('X-FRAMEWORK-VERSION', $app->getVersion());

                return $request;
            },
            true
        );

        // register the response
        $this->bind(
            'http.response',
            function () use (&$app) {
                return $app->make('http.request')->getResponse();
            },
            true
        );
    }
}
