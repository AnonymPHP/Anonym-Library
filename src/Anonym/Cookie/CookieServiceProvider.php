<?php

namespace Anonym\Cookie;

use Anonym\Application\ServiceProvider;
use Anonym\Cookie\CookieInterface;
use Anonym\Cookie\Base64Encoder;
use Anonym\Facades\Config;
use Anonym\Support\Arr;

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


            $configs = Config::get('stroge.cookie.crypting');

            $cookie =  new Cookie(Arr::get($configs, 'encode', true));
            $encoder = $this->make(Arr::get($configs, 'encoder', Base64Encoder::class));

            return $cookie->setEncoder($encoder);
        });
    }

}
