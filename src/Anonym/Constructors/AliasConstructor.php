<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Constructors;


use Anonym\Bootstrap\AliasLoader;
use Anonym\Facades\Config;

/**
 * the provider of alias
 *
 * Class AliasProvider
 * @package Anonym\Providers
 */
class AliasConstructor
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function __construct()
    {
        AliasLoader::setInstances(Config::get('general.alias'));
    }
}
