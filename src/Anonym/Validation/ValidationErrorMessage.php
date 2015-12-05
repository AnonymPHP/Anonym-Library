<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Validation;

/**
 * Class ValidationErrorMessage
 * @package Anonym\Validation
 */
class ValidationErrorMessage
{

    protected $errors = [];

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return ValidationErrorMessage
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }
}
