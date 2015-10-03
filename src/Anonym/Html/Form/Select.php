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
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     */
    public function __construct($expression, $options = []){
        parent::__construct($expression);

        $this->setOptions($options);
    }


    /**
     * add a option
     *
     * @param array $options
     * @return $this
     */
    public function option($options = []){
        return $this->value($options);
    }

    /**
     * add a new option value
     *
     * @param array $options
     * @return $this
     */
    public function value($options = []){

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
