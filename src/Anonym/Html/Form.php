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
use Anonym\Html\Form\Close;
use Anonym\Html\Form\Open;
use Anonym\Html\Form\Select;
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

        'open' => "<form :options>:token_input \n",
        'input' => "<input :options /> \n",
        'select' => "<select :options>:values</select> \n",
        'option' =>"<option :options>:content</option> \n",
        'close' => '</form>'

    ];


    /**
     * the value of csrf security
     *
     * @var bool
     */
    protected $csrf;

    /**
     *  create a new instance and register csrf status
     * @param bool|true $csrf
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
    public function expression($name)
    {
        return Arr::get($this->expressions, $name, '');
    }

    /**
     * create a new form
     *
     * @param array|string $options
     * @return string
     */
    public function open($options = [])
    {
        if (is_string($options)) {
            $options = ['class' => $options];
        }

        $open = new Open($this->expression('open'), $options, $this->csrf, $this);
        return $open;
    }

    /**
     * add a new input
     *
     *
     * @param array|string $options
     * @return Input
     */
    public function input($options = [])
    {
        if (is_string($options)) {
            $options = ['class' => $options];
        }

        $input = new Input($this->expression('input'), $options);

        return $input;
    }

    /**
     * add a new select option
     *
     * @param  array|string $options
     * @return Select
     */
    public function select($options = []){
        if (is_string($options)) {
            $options = ['class' => $options];
        }

        return new Select($this->expression('select'), $options, $this);
    }

    /**
     * add a new submit button
     *
     * @param array $options
     * @return Input
     */
    public function submit($options = [])
    {
        if (is_string($options)) {
            $options = ['value' => $options];
        }

        if (!Arr::has($options, 'type')) {
            Arr::set($options, 'type', 'submit');
        }

        $input = new Input($this->expression('input'), $options);

        return $input;
    }

    /**
     * create a new checkbox input
     *
     * @param array|string $options
     * @return Input
     */
    public function checkbox($options)
    {

        if (is_string($options)) {
            $options = ['class' => $options];
        }

        if (!Arr::has($options, 'type')) {
            Arr::set($options, 'type', 'checkbox');
        }

        return $this->input($options);
    }

    /**
     * create a new instance
     *
     * @return Close
     */
    public function close(){
        return new Close($this->expression('close'));
    }

    /**
     * create a new radio input
     *
     * @param array $options
     * @return Input
     */
    public function radio($options = []){
        if (is_string($options)) {
            $options = ['class' => $options];
        }elseif(is_bool($options)){
            $options = [
                'checked' => 'checked'
            ];
        }

        if (!Arr::has($options, 'type')) {
            Arr::set($options, 'type', 'radio');
        }

        return $this->input($options);
    }
}
