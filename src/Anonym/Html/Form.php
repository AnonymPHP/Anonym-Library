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
