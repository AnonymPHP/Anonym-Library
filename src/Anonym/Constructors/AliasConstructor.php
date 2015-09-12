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
        $aliases = $app->getGeneral()['alias'];
        AliasLoader::setInstances($aliases);

        // add the aliases to singleton
        foreach($aliases as $key => $value)
        {
            $app->singleton($key, function() use($key){
               return (new AliasLoader())->load($key);
            });
        }

        $app->instance('app', $app);

        $app->instance('facade', new Facade($app));
    }
}
