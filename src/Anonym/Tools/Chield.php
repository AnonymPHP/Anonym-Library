<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Tools;

/**
 * Class Chield
 * @package Anonym\Components\Tools
 */
class Chield implements TableInterface
{

    /**
     * the pattern of command
     *
     * @var string
     */
    private $pattern;

    /**
     * determine if it is null
     *
     * @var bool
     */
    private $null = false;

    /**
     *
     *
     * @var string
     */
    private $default;


    /**
     * the datas of pattern
     *
     * @var array
     */
    private $values;

    /**
     * the instance of table
     *
     * @var Table
     */
    private $app;

    /**
     * @param Table $table
     * @param string $pattern
     * @param array $values
     */
    public function __construct(Table $table, $pattern, array $values = [])
    {
        $this->app = $table;
        $this->pattern = $pattern;
        $this->values = $values;
    }


    /**
     * register null variable
     *
     * @param bool|true $null
     * @return $this
     */
    public function null($null = true)
    {
        $this->null = $null;
        return $this;
    }

    /**
     * register default variable
     *
     * @param mixed $defualt
     * @return $this
     */
    public function defualt($defualt){
        $this->default = $defualt;

        return $this;
    }


    /**
     * rende parameters
     *
     *
     * @return string
     */
    public function rende(){

        $null = $this->null === false ? 'NOT NULL': 'NULL';
        $default = $this->default ? sprintf(" DEFAULT '%s'", strval($this->default)) : '';

        $content = call_user_func_array('sprintf', array_merge([$this->pattern], $this->values));
        return $content.' '.$null.$default.',';
    }

    /**
     * @param string $name
     * @param array $method
     * @return mixed
     */
    public function __call($name, $method){
        return call_user_func_array([$this->app, $name], $method);
    }

    /**
     * add a text string to value
     *
     * @param string $name
     * @return Chield
     */
    public function text($name)
    {
         return $this->app->text($name);
    }

    /**
     * add a new varchar command
     *
     * @param string $name
     * @param int $limit
     * @return Chield
     */
    public function varchar($name, $limit = 255)
    {
        return $this->app->varchar($name, $limit);
    }

    /**
     * add a new date command
     *
     * @param  string $name
     * @return Chield
     */
    public function date($name)
    {
        return $this->app->date($name);
    }

    /**
     * add a new integer command
     *
     * @param string $name
     * @param int $limit
     * @return Chield
     */
    public function int($name, $limit = 255)
    {
        return $this->app->int($name, $limit);
    }

    /**
     * add a new time string
     *
     * @param string $name
     * @return Chield
     */
    public function time($name)
    {
        return $this->app->time($name);
    }

    /**
     * add a new timestamp column to mysql
     *
     * @param string $name
     * @return Chield
     */
    public function timestamp($name)
    {
        return $this->app->timestamp($name);
    }

    /**
     * add a new year year column to mysql
     *
     * @param string $name
     * @return Chield
     */
    public function year($name)
    {
        return $this->app->year($name);
    }

    /**
     * add a new auto_increment column to mysql
     *
     * @param string $name
     * @param int $limit
     * @return mixed
     */
    public function primary($name, $limit = 255)
    {
        return $this->app->primary($name, $limit);
    }

    /**
     * add a new time stamp with CURRENT_TIMESTAMP
     *
     * @param string $name
     * @return Chield
     */
    public function current($name)
    {
        return $this->app->current($name);
    }
}
