<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Facades;

use Anonym\Components\Element\Element as ElementOrm;
use Anonym\Patterns\Singleton;

/**
 * Class Element
 * @package Anonym\Components\Facade
 */
class Element
{

    /**
     * @var ElementOrm
     */
    public $orm;

    /**
     * Sınıfı başlatır
     */
    public function __construct()
    {
        $this->orm = new ElementOrm(Singleton::bind('database.base'));
        $this->orm->setTable($this->findCalledClassTableVariable());
    }

    /**
     * Hangi sınıftan çağrıldığını arar
     *
     * @return mixed
     */
    private function findCalledClassTableVariable()
    {
        $class = get_called_class();
        return $this->resolveClassName($class);
    }


    /**
     * resolve the class name
     *
     * @param string $name
     * @return mixed
     */
    private function resolveClassName($name = '')
    {
        $explodeClass = explode('\\', $name);
        return end($explodeClass);
    }

    /**
     * Static kullanım desteği
     *
     * @param       $method
     * @param array $params
     * @return mixed
     */
    public static function __callStatic($method, $params = [])
    {
        $instance = new static();

        return call_user_func_array([$instance->orm, $method], $params);
    }

    /**
     * call the methods
     *
     * @param       $method
     * @param array $params
     * @return mixed
     */
    public function __call($method, $params = [])
    {
        return call_user_func_array([$this->orm, $method], $params);
    }
}
