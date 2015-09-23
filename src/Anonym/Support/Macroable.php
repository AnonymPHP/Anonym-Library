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

use Closure;
use BadMethodCallException;
/**
 * Class Macroable
 * @package Anonym\Support
 */
class Macroable
{

    /**
     * the all macros
     *
     * @var array
     */
    protected $macros;

    /**
     * add a new closure callback function to class with macros
     *
     * @param string $name
     * @param Closure $callback
     * @return $this
     */
    public function macro($name, Closure $callback){
        $this->macros[$name] = Closure::bind($callback, $this, get_class());

        return $this;
    }

    /**
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args){
        if (isset($this->macros[$method])) {
            return call_user_func_array($this->macros[$method], $args);
        }else{
            throw new BadMethodCallException(sprintf('%s method is not exists', $method));
        }
    }
}
