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

        $configs = Config::get('crypt');

        $this->bind(AnonymCrypt::class, function () use($configs){
            $crypter = new AnonymCrypt();

            if(false !== $mode = Arr::get($configs, 'mode', false)){
                $crypter->setMode($mode);
            }

            if(false !== $rand = Arr::get($configs, 'rand', false)){
                $crypter->setRand($rand);
            }

            if(false !== $alogirtym = Arr::get($configs, 'alogirtym', false)){
                $crypter->setAlogirtym($alogirtym);
            }

            return $crypter;
        });

        $app = $this;
        $this->singleton(Crypter::class, function() use($configs, $app){

            $crypter = Arr::get(Config::get($configs), 'crypter', AnonymCrypt::class);


            return (new Crypter())->setCrypter($app->make($crypter));
        });

    }
}
