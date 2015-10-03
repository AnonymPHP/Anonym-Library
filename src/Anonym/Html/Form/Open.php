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
 * Class Open
 * @package Anonym\Html\Form
 */
class Open extends ExpressionFactory
{

    use FormHaveOptions;

    /**
     * the instance of form
     *
     * @var Form
     */
    protected $form;
    /**
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     */
    public function __construct($expression, array $options = [], Form $form = null){
        parent::__construct($expression);
        $this->form = $form;
        $this->setOptions($options);
    }

    /**
     * create the form content
     *
     * @return mixed
     */
    public function execute(){

    }
}

