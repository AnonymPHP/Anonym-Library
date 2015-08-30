<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Patterns;

use Anonym\Bootstrap\AliasLoader;
use InvalidArgumentException;
/**
 * Class Facade
 * @package Anonym\Patterns
 */
class Facade
{

    /**
     * load the facade instance
     *
     * @return bool|Object
     * @throws FacadeException
     */
    public function load(){
        return static::resolveFacadeClass(static::getFacadeClass());
    }

    /**
     * get the facade class
     *
     * @throws FacadeException
     * @return string|Object
     */
    protected static function getFacadeClass()
    {
        throw new FacadeException('i can not call myself');
    }

    /**
     * do resolve returned value
     *
     * @param mixed $class
     * @throws InvalidArgumentException
     * @return Object|bool
     *
     */
    private static function resolveFacadeClass($class)
    {
        if(is_string($class))
        {
            $class = (new AliasLoader())->load($class);
        }elseif(is_object($class))
        {
            if($class instanceof Facade)
            {
                throw new InvalidArgumentException('Your class must not be a Facade');
            }
        }else{
            return false;
        }

        return $class;
    }

    /**
     * call the method in registered instances
     *
     * @param string $method the name of method
     * @param array $args the variables for method
     * @return mixed
     */
    public static function __callStatic($method, $args = [])
    {
        $instance = static::resolveFacadeClass(static::getFacadeClass());

        return call_user_func_array([$instance, $method], $args);
    }

    /**
     * call the method in registered instances
     *
     * @param string $method the name of method
     * @param array $args the variables for method
     * @return mixed
     */
    public function __call($method, $args)
    {
        $instance = static::resolveFacadeClass(static::getFacadeClass());

        return call_user_func_array([$instance, $method], $args);
    }
}