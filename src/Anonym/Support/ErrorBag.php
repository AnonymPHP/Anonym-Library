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

    /**
     *  start the error bag
     *
     * @return mixed
     */
    public function init(){
        if ($errors = Session::has(self::SESSION_ERROR_NAME)) {
            $this->errors = $errors;
        }

        $this->clean();

        return;
    }
    /**
     *
     * @return $this
     */
    public function run(){
        Session::set(self::SESSION_ERROR_NAME, $this->errors);
        return $this;
    }

    /**
     * clean errors
     *
     * @return $this
     */
    public function clean(){
        Session::delete(self::SESSION_ERROR_NAME);

        return $this;
    }


}