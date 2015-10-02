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
class ExpressionFactory
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
}
