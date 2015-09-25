<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Components\Security;

/**
 * the class of type hint
 *
 * uses for string,integer,array,float,resource types hint
 *
 * Class TypeHint
 * @package Anonym\Components\Security
 */
class TypeHint
{

    /**
     * store the types
     *
     * @var array
     */
    public static $types = [

        'integer'  => 'is_integer',
        'string'   => 'is_string',
        'float'    => 'is_float',
        'resource' => 'is_resource',
        'double'   => 'is_double'

    ];

    /**
     * register the error handler
     *
     * @access public
     */
    public static function boot()
    {

        set_error_handler('Anonym\Security\TypeHint::hint');
    }

    /**
     * handle the error
     *
     * @param integer $errLevel the level of error
     * @param string $errMessage the message of error
     * @return bool true on success, if failure happen return false
     */
    public static function handle($errLevel, $errMessage)
    {

        if ($errLevel === E_RECOVERABLE_ERROR) {

            if ($explode = explode(' ', $errMessage)) {

                if (
                    $explode[0] === 'Argument' &&
                    $explode[2] === 'passed' &&
                    $explode[3] === 'to' &&
                    $explode[5] === 'must' &&
                    $explode[20] === 'defined'
                ) {
                    $arg = $explode[1] - 1;
                    $mustType = $explode[10];
                    $back = debug_backtrace()[1];
                    $explode = explode('\\', $mustType);
                    $end = end($explode);
                    $getLastType = rtrim($end, ',');
                    $args = $back['args'];
                    $arg = $args[$arg];
                    if (gettype($arg) != $getLastType) {
                        if (call_user_func(static::$types[$getLastType], $arg)) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
