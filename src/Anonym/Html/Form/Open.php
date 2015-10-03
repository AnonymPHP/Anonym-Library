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
     * @var bool
     */
    protected $csrf;
    /**
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     * @param bool|true $csrf
     * @param Form $form
     */
    public function __construct($expression, array $options = [], $csrf = true, Form $form = null){
        parent::__construct($expression);
        $this->form = $form;
        $this->csrf = $csrf;
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

