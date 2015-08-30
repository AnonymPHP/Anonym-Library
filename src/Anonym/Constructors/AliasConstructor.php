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
use Anonym\Bootstrap\Bootstrap;
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
    public function __construct(Bootstrap $app)
    {
        $aliases = Config::get('general.alias');

        AliasLoader::setInstances($aliases);
    }
}
