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
use Anonym\Bootstrap\Bootstrap;
use Anonym\Application\AliasLoader;
use Anonym\Patterns\Facade;

/**
 * the provider of alias
 *
 * Class AliasProvider
 * @package Anonym\Providers
 */
class AliasConstructor
{


    /**
     * register the providers
     *
     * @param Bootstrap $app
     * @return mixed
     */
    public function __construct(Bootstrap $app)
    {
        Facade::setApplication($app);

        $aliases = $app->getGeneral()['alias'];
        $loader = new AliasLoader($aliases);

        $loader->register();
    }
}
