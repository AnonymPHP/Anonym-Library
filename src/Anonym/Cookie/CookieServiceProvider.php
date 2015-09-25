<?php

namespace Anonym\Cookie;

use Anonym\Bootstrap\ServiceProvider;
use Anonym\Facades\Config;

/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */
class CookieServiceProvider extends ServiceProvider
{

    /**
     *
     *  register the provider
     *
     */
    public function register()
    {
        $this->singleton('cookie', function () {
            $encode = Config::get('stroge.cookie.encode');

            return new Cookie($encode);
        });
    }

}
