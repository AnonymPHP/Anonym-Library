<?php
namespace Anonym\Html\Form;

/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */
abstract class ExpressionFactory
{

    /**
     * the string of expression
     *
     * @var string
     */
    protected $expression;

    /**
     * the type of array for values
     *
     * @var array
     */
    protected $values;

    /**
     * create the form content
     *
     * @return mixed
     */
    abstract public function execute();
    /**
     * @param string $expression
     */
    public function __construct($expression){
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     * @return $this
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * replace tokens and return new string
     *
     * @param array $tokens
     * @return mixed
     */
    public function replaceTokens($tokens){
        $keys = array_keys($tokens);
        $values = array_values($tokens);

        return str_replace($keys, $values, $this->getExpression());
    }

    /**
     * create string value
     *
     * @return mixed
     */
    public function __toString(){
        return $this->execute();
    }
}
