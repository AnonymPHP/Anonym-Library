<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Support;


class ErrorBag
{

    /**
     * an array type of errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * add an error
     *
     * @param string $message
     */
    public function add($message = ''){
        $this->errors[] = $message;

        return $this;
    }

    /**
     * get an  error
     *
     * @param int $index
     * @return string
     */
    public function get($index){
        return isset($this->errors[$index]) ? $this->errors[$index] : '';
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return ErrorBag
     */
    public function setErrors(array $errors = [])
    {
        $this->errors = $errors;
        return $this;
    }



}