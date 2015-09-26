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

use Anonym\Session\StrogeInterface;
use Anonym\Support\ErrorBag;
use Anonym\Route\AsCollector;

/**
 * Class Redirect
 * @package Anonym\Http
 */
class Redirect
{

    /**
     * the instance of session
     *
     * @var StrogeInterface
     */
    protected $session;
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
     * @param StrogeInterface $session
     */
    public function __construct(ErrorBag $errorBag, StrogeInterface $session){
        $this->errorBag = $errorBag;
        $this->session = $session;
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
     * add or set error messages
     *
     * @param array|string $message
     * @return $this
     */
    public function withError($message){
        if (is_array($message)) {
            $this->errorBag->setErrors($message);
        }else{
            $this->errorBag->add($message);
        }

        return $this;
    }

    public function withInput($name, $message = null){
        if(!is_array($name)){
            $name = [$name, $message];
        }

        foreach($name as $name => $message){
            $this->session->set($name, $message);
        }

        return $this;
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
