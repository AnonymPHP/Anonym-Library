<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Html\Form;
use Anonym\Html\Form;

/**
 * Class Select
 * @package Anonym\Html\Form
 */
class Select extends ExpressionFactory
{

    use FormHaveOptions;

    /**
     * the type of array to option values
     *
     * @var array
     */
    protected $values;

    /**
     * the instance of Form
     *
     * @var Form
     */
    protected $form;
    /**
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     * @param Form $form
     */
    public function __construct($expression, $options = [], Form $form){
        parent::__construct($expression);

        $this->form = $form;
        $this->setOptions($options);
    }


    /**
     * add a option
     *
     * @param array $options
     * @param string $content
     * @return $this
     */
    public function option($options = [], $content = ''){
        return $this->value($options);
    }

    /**
     * add a new option value
     *
     * @param array $options
     * @param string $content
     * @return $this
     */
    public function value($options = [], $content = ''){
        if (is_string($options)) {
            $options = ['value' => $options];
        }

        $this->values[] = new Option($this->form->expression('option'), $options, $content);
    }


    /**
     * create the form content
     *
     * @return mixed
     */
    public function execute()
    {

    }
}

