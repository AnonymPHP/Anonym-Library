<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Providers;


use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\Cookie\UseCookieHeaders;

/**
 * Class CookieProvider
 * @package Anonym\Providers
 */
class CookieProvider extends ServiceProvider
{


    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $cookies = new UseCookieHeaders();
        $cookies->useCookies();
    }
}

