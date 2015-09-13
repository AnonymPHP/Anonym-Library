<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Auth;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Security\Authentication\Login;

/**
 * Class LastLogins
 * @package Anonym\Auth
 */
class LastLogins
{

    /**
     * @var Base
     */
    private $base;

    /**
     * create a new instance and register base instance
     *
     * @param Base $base
     */
    public function __construct(Base $base)
    {

        $this->base = $base;
    }

    private function buildQuery($limit = null)
    {

        $table = Login::LOGIN_LOGS_TABLE;

        return $this->base->read($table, function (Read $read) use ($limit) {
            $read->select('*');

            if (null !== $limit) {
                $read->limit($limit);
            }
        });
    }
}
