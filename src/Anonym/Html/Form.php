<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Html;
use Anonym\Facades\Config;
use Anonym\Html\Form\Open;
use Anonym\Support\Arr;

/**
 * Class Form
 * @package Anonym\Html
 */
class Form
{

    /**
     * the type of array for expressions
     *
     * @var array
     */
    protected $expressions = [

        'open' => '<form :options>:token_input',
        'input' => '<input :options />',
        'select' => '<select :options>:values</select>',
        'option' => '<option value=":value">:content</option>',
        'close' => '</form>'

    ];

    /**
     * the values of expressions
     *
     * @var array
     */
    protected $values;

    /**
     * the value of csrf security
     *
     * @var bool
     */
    protected $csrf;

    /**
     *  create a new instance and register csrf status
     */
    public function __construct(){
        $this->csrf = Config::get('security.csrf.status');
    }

    /**
     * return the expression value
     *
     * @param string $name
     * @return mixed
     */
    protected function expression($name){
        return Arr::get($this->expressions, $name, '');
    }
    /**
     * create a new form
     *
     * @param array $options
     */
    public function open(array $options = []){
        $this->values[] = new Open($this->expression('open'), $options);

        return $this;
    }

}
