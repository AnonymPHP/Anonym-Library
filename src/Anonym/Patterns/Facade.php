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
use Anonym\Bootstrap\Container;
use Anonym\Facades\App;
use InvalidArgumentException;
/**
 * Class Facade
 * @package Anonym\Patterns
 */
class Facade
{


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
     */
    private static function resolveFacadeClass($class)
    {

        $class = is_string($class) ? $class : get_class($class);

        App::singleton($class, function($abstract){
            if (is_string($abstract)) {
                return (new AliasLoader())->load($abstract);
            }elseif(is_object($abstract) && !$abstract instanceof Facade){
                return $abstract;
            }else{
                throw new InvalidArgumentException('Your class cant be an instance of facade or anything else');
            }
        });

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
        static::resolveFacadeClass(static::getFacadeClass());

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
