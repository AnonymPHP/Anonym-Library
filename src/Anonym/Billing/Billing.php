<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;
use Anonym\Database\Database;

/**
 * Class Billing
 * @package Anonym\Billing
 */
class Billing
{

    /**
     * @var Database
     */
    protected $database;

    /**
     * the table name of cashier
     *
     * @var string
     */
    protected $table;

    /**
     * the constructor of Billing .
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
}
