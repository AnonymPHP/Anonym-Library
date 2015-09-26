<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Http;


use Anonym\Application\ServiceProvider;
use Anonym\Facades\Redirect;

/**
 * Class RedirectServiceProvider
 * @package Anonym\Http
 */
class RedirectServiceProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     */
    public function register()
    {
        $this->listenEvent('redirect:sending', function () {
            Redirect::send();
        });
    }
}
