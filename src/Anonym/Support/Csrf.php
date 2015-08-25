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

use Anonym\Bootstrap\Container;

/**
 * Class Csrf
 * @package Anonym\Support
 */
class Csrf
{

    use Container;

    /**
     * get the csrf token
     *
     * @return bool|string
     * @throws \Anonym\Bootstrap\BindNotFoundException
     * @throws \Anonym\Bootstrap\BindNotRespondingException
     */
    public function getToken()
    {
        return $this->isBinded('security.csrf') ? $this->make('security.csrf')->getToken() : false;
    }
}
