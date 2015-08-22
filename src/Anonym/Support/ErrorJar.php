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
 * the handler of error
 *
 * Class ErrorJar
 * @package Anonym\Support
 */
class ErrorJar
{

    /**
     * the message of error
     *
     * @var string
     */
    private $message;

    /**
     * the file name of error
     *
     * @var string
     */
    private $file;

    /**
     * the file line of error
     *
     * @var string
     */
    private $line;


    /**
     * the error code of error
     *
     * @var string
     */
    private $code;


}