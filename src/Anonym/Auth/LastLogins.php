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

}
