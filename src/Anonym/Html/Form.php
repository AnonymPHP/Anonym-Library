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
use Anonym\Html\Form\Input;
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
     *  @param bool $csrf
     */
    public function __construct($csrf = true)
    {
        $this->csrf = $csrf;
    }

    /**
     * return the expression value
     *
     * @param string $name
     * @return mixed
     */
    protected function expression($name)
    {
        return Arr::get($this->expressions, $name, '');
    }

    /**
     * create a new form
     *
     * @param array $options
     */
    public function open(array $options = [])
    {
        $this->values[] = new Open($this->expression('open'), $options, $this->csrf);

        return $this;
    }

    /**
     * add a new input
     *
     * @param array $options
     * @return $this
     */
    public function input($options = []){
        if (is_string($options)) {
            $options = ['class' => $options];
        }

        $this->values[] = new Input($this->expression('input', $options));

        return $this;
    }
}
