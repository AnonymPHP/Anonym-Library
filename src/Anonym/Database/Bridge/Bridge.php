<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Bridge;

/**
 * Class Bridge
 * @package Anonym\Database\Bridge
 */
abstract class Bridge
{

    /**
     * an array type for connectione configuration values
     *
     *
     * @var array
     */
    protected $configurations;

    /**
     * the constructor of Bridge .
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }

    /**
     * the abstract function for open bridge
     *
     * @return mixed
     */
    abstract public function open();
}
