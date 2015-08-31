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
     * register the providers
     *
     * @param Bootstrap $app
     * @return mixed
     */
    public function __construct(Bootstrap $app)
    {
        $aliases = Config::get('general.alias');

        // add the aliases to singleton
        foreach($aliases as $alias)
        {
            $app->singleton($alias, function() use($alias){
               return (new AliasLoader())->load($alias);
            });
        }

        AliasLoader::setInstances($aliases);
    }
}
