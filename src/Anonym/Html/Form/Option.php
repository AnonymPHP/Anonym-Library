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
 * Class Option
 * @package Anonym\Html\Form
 */
class Option extends ExpressionFactory
{

    /**
     * the content of option element
     *
     * @var string
     */
    protected $content;

    use FormHaveOptions;
    /**
     * create a new instance and register expression and options
     *
     * @param string $expression
     * @param array $options
     * @param string $content
     */
    public function __construct($expression, $options = [], $content = ''){
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

