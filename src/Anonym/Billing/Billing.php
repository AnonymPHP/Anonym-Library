<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;

/**
 * Class Billing
 * @package Anonym\Billing
 */
class Billing
{

    /**
     * @var Base
     */
    protected $base;

    /**
     * the table name of cashier
     *
     * @var string
     */
    protected $table;
    /**
     * the constructor of Billing .
     * @param Base $base
     */
    public function __construct(Base $base)
    {
        $this->base = $base;
    }
}
