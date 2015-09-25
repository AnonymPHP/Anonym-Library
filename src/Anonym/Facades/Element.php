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
use  Anonym\Database\Base;
use Anonym\Element\Element as Orm;
class Element
{

    /**
     * the instance of database
     *
     * @var Base
     */
    protected $base;

    /**
     * the instance of orm
     *
     * @var Orm
     */
    protected $orm;
    /**
     *  create a new instance and register database instance
     */
    public function __construct(){
        $this->setBase(App::make('database.base'));
        $this->setOrm(new Orm($this->getBase()));
        $this->table($this->findConnectedTable());
    }

    /**
     * @return Orm
     */
    public function getOrm()
    {
        return $this->orm;
    }

    /**
     * @param Orm $orm
     * @return Element
     */
    public function setOrm(Orm $orm)
    {
        $this->orm = $orm;
        return $this;
    }

    /**
     * find user called table
     *
     * @return mixed
     */
    private function findConnectedTable(){
        $vars = get_class_vars(get_called_class());

        if (isset($vars['table'])) {
            return $vars['table'];
        }
    }




    /**
     * @return Base
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param Base $base
     * @return Model
     */
    public function setBase(Base $base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * call method in orm if cant find in this class
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($method, $args){

        $app = new static();

        return call_user_func_array([$app->getOrm(), $method ], $args);
    }
    /**
     * call method in orm if cant find in this class
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, $args){
        return call_user_func_array([$this->getOrm(), $method ], $args);
    }
}
