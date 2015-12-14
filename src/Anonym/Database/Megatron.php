<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

/**
 * Class Megatron
 * @package Anonym\Database
 */
class Megatron
{

    /**
     * @var array
     */
    protected $vars;

    /**
     * the constructor of Megatron .
     * @param array $vars
     */
    public function __construct($vars)
    {
        $this->vars = $vars;
    }

    /**
     * handle and execute class vars
     */
    protected function handleClassVars()
    {
        // set selected columns
        if (isset($this->vars['select'])) {
            $this->getQueryBuilder()->select($this->vars['select']);
        }

        if (isset($this->vars['from'])) {
            $this->getQueryBuilder()->
        }
    }
}