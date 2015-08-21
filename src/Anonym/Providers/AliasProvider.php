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


use Anonym\Bootstrap\AliasLoader;
use Anonym\Bootstrap\ServiceProvider;
use Anonym\Facades\Config;

/**
 * the provider of alias
 *
 * Class AliasProvider
 * @package Anonym\Providers
 */
class AliasProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        AliasLoader::setInstances(Config::get('general.alias'));
    }
}