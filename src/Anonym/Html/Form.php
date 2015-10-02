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
     * create a new form
     *
     * @param array $options
     */
    public function open(array $options = []){
        $this->values[] = new Open($options);

        return $this;
    }

}
