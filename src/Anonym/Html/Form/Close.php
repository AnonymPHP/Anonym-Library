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
 * Class Close
 * @package Anonym\Html\Form
 */
class Close extends ExpressionFactory
{

    /**
     * create the form content
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->getExpression();
    }
}

