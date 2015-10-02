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
 * Class Input
 * @package Anonym\Html\Form
 */
class Input extends ExpressionFactory
{
    use FormHaveOptions;


    /**
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     */
    public function __construct($expression, array $options = []){
        parent::__construct($expression);

        $this->setOptions($options);
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