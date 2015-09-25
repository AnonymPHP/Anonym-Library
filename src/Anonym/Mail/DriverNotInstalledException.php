<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Mail;

/**
 * throw the exception
 *
 * Class DriverNotInstalledException
 * @package Anonym\Components\Mail
 */
class DriverNotInstalledException extends DriverException
{

    /**
     * throw the exception
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        parent::__construct($message);
    }

}
