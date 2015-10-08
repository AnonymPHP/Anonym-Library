<?php

namespace Anonym\Cookie;

use Anonym\Application\ServiceProvider;
use Anonym\Cookie\CookieInterface;
use Anonym\Crypt\CryptInterface;
use Anonym\Facades\Config;
use Anonym\Crypt\Crypter;
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

        $app = $this->app();

        $this->singleton(CookieInterface::class, function () use(&$app){
            $configs = Config::get('stroge.cookie.crypting');

            $cookie =  new Cookie($configs);

            return $cookie->setEncoder($app->app->make(CryptInterface::class));
        });
    }

}
