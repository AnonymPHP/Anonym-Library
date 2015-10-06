<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Route;

use Anonym\Http\Request;
use Anonym\Security\Validation;

/**
 * the parent class of controllers
 *
 * Class Controller
 * @package Anonym\Route
 */
abstract class Controller
{
    use Middleware, ModelDispatcher;

    /**
     * an array of callable functions for prepare somethings
     *
     * @var array
     */
    protected $callbacks;

    /**
     * repository of parameters
     *
     * @var array
     */
    private $parameters;


    /**
     * create a instance and register callbacks
     *
     */
    public function __construct()
    {
        $this->callbacks = [
            [$this, 'protectFromForgery'],
        ];
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     *  prepare csrf token protection if $this->protectFormForgery is true
     *
     *  @return void
     */
    protected function protectFromForgery()
    {

    }
    /**
     * register the parameters
     *
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
        return $this;
    }


    /**
     * validate the form
     *
     * @param Request $request
     * @param array $rules
     * @param array $filters
     */
    public function validate(Request $request, array $rules = [], array $filters = [])
    {
        $all = $request->all();

        return $request->getValidation()->make($all, $rules, $filters);
    }


    /**
     * register parameters and run constructors
     *
     * @param array $parameters
     */
    public function runControllerWithParameters($parameters = [])
    {
        $this->setParameters($this->toArray($parameters));


    }

    /**
     * if $parameters is not an array, we gonna replace $parameter to array
     *
     * @param $parameters
     * @return array|\ArrayIterator
     */
    private function toArray($parameters)
    {
        return is_array($parameters) ? $parameters : (array)$parameters;
    }
}
