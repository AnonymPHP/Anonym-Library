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
use Anonym\Support\Arr;

/**
 * Class Open
 * @package Anonym\Html\Form
 */
class Open extends ExpressionFactory
{

    use FormHaveOptions, BuildCsrfField;

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
        $this->setOptions($this->prepareOptions($options));
    }

    /**
     * prepare options for build
     *
     * @param array $options
     * @return array
     */
    private function prepareOptions(array $options){
        if (!Arr::has($options, 'method')) {
            Arr::set($options, 'method', 'post');
        }

        if (!Arr::has($options, 'action')) {
            Arr::set($options, 'action', '');
        }

        return $options;
    }

    /**
     * create the form content
     *
     * @return mixed
     */
    public function execute(){
        $formOptions = $this->buildOptions();

        return $this->replaceTokens([
            ':options' => $formOptions,
            ':token_field' => true === $this->csrf ? $this->createCsrfField() : ''
        ]);
    }
}

