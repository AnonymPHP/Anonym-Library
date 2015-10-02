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
 * Class FormHaveOptions
 * @package Anonym\Html\Form
 */
trait FormHaveOptions
{
    /**
     * the type of array for options values
     *
     * @var array
     */
    protected $options;

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return FormHaveOptions
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}

