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

        $this->singleton(AnonymCrypt::class, function () {
            $crypter = new AnonymCrypt();
            $configs = Config::get('crypt');

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



    }
}
