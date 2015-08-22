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

/**
 * Class ErrogBag
 * @package Anonym\Support
 */
class ErrogBag
{

    /**
     * the repository of php errors
     *
     * @var array
     */
    private static $errors;

    /**
     * the repository of php exceptions
     *
     * @var array
     */
    private static $exceptions;




    /**
     * @return array
     */
    public static function getErrors()
    {
        return self::$errors;
    }

    /**
     * @param array $errors
     */
    public static function setErrors($errors)
    {
        self::$errors = $errors;
    }

    /**
     * @return array
     */
    public static function getExceptions()
    {
        return self::$exceptions;
    }

    /**
     * @param array $exceptions
     */
    public static function setExceptions($exceptions)
    {
        self::$exceptions = $exceptions;
    }



}