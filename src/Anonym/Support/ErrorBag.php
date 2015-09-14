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


use Anonym\Facades\Session;

/**
 * Class ErrorBag
 * @package Anonym\Support
 */
class ErrorBag
{

    const SESSION_ERROR_NAME = 'error_bag_errors';

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
     * @return $this
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
        $return =  $this->errors;

        $this->errors = [];
        return $this;
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

    /**
     *
     * @return $this
     */
    public function run(){
        Session::set(self::SESSION_ERROR_NAME, $this->errors);
        return $this;
    }


}