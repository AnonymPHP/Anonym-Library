<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Http;

use Anonym\Support\ErrorBag;
use Anonym\Route\AsCollector;

/**
 * Class Redirect
 * @package Anonym\Http
 */
class Redirect
{

    /**
     * the instance of error bag
     *
     * @var ErrorBag
     */
    protected $errorBag;

    /**
     * create a new instance with error bag
     *
     * @param ErrorBag $errorBag
     */
    public function __construct(ErrorBag $errorBag){
        $this->errorBag = $errorBag;
    }
    /**
     * redirect user to somewhere else
     *
     * @param string $url
     * @param int $time
     */
    public function to($url = '', $time = 0)
    {
        $redirect = new RedirectResponse($url, $time);
        $redirect->send();
    }

    /**
     * redirect user to it referer url
     *
     * @param int $time
     */
    public function back($time = 0){
        $redirect = new RedirectResponse((new Request())->back(), $time);
        $redirect->send();
    }



    /**
     * redirect to a route
     *
     * @param string $name
     * @throws RouteNotFoundException
     */
    public function route($name = ''){
        $routes = AsCollector::getAs();

        if (isset($routes[$name])) {
            $this->to($routes[$name]);
        }else{
            throw new RouteNotFoundException(sprintf('%s Route Not Found'));
        }
    }


    /**
     * register errors
     *
     * @param array $errors
     * @return $this
     */
    public function withErrors($errors = []){
        errorr()->setErrors($errors)->run();

        return $this;
    }
}
