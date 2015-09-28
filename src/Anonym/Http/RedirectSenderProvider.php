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
 * Class RedirectSenderProvider
 * @package Anonym\Http
 */
class RedirectSenderProvider extends ServiceProvider
{

    /**
     * determine and send redirect responses
     */
    public function register(){
        if(Redirect::isStarted() && false === Redirect::isSended()){
            Redirect::send();
        }
    }

}
