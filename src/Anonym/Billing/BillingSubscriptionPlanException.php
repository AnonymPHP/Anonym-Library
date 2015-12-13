<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;

use Exception;

/**
 * Class BillingSubscriptionPlanException
 * @package Anonym\Billing
 */
class BillingSubscriptionPlanException extends Exception
{

    /**
     * the constructor of BillingSubscriptionPlanException .
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
