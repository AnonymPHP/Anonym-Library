<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Crypt;

use Anonym\Application\ServiceProvider;
use Anonym\Facades\Config;
use Anonym\Support\Arr;

/**
 * Class CrypterServiceProvider
 * @package Anonym\Crypt
 */
class CrypterServiceProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {

        $app = $this->app;

        $this->singleton(Crypter::class, function() use($app){

            return (new Crypter())->setCrypter((new AnonymCrypt())->useConfigs($app['configs']->get('crypt')));
        });

    }
}
