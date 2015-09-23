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


}
