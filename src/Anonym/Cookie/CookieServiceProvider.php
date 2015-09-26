<?php

namespace Anonym\Cookie;

use Anonym\Application\ServiceProvider;
use Anonym\Cookie\CookieInterface;
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
        $this->singleton(CookieInterface::class, function () {
            $encode = Config::get('stroge.cookie.encode');

            return new Cookie($encode);
        });
    }

}
