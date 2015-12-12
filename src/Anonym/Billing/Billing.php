<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;

use Anonym\Database\Database;
use Anonym\Facades\Config;

/**
 * Class Billing
 * @package Anonym\Billing
 */
class Billing extends Database
{


    /**
     * the table name of cashier
     *
     * @var string
     */
    protected $table;

    /**
     * @var int
     */
    protected $selectedUserId;

    /**
     * the constructor of Billing .
     * @param int $selectedUserId
     */
    public function __construct($selectedUserId = 0)
    {
        $this->table = Config::get('database.tables.billing');
        $this->selectedUserId = $selectedUserId;
        $this->where('user_id', $selectedUserId);
        parent::__construct();
    }

    /**
     * return or set the cash amount
     *
     * @param null $cash
     * @return mixed
     */
    public function cash($cash = null)
    {
        if ($cash !== null) {
            $this->update([
                'cash' => $cash
            ]);
        } else {
            return $this->getFirstAttribute()['cash'];
        }
    }

}
