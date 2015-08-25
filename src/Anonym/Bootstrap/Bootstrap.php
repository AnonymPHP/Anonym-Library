<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Bootstrap;

use Anonym\Constructors\RequestConstructor;
use Anonym\Constructors\HandlerConstructor;
use Anonym\Constructors\ConfigConstructor;
use Anonym\Constructors\AliasConstructor;
use Anonym\Constructors\DatabaseConstructor;
use Anonym\Facades\Config;

/**
 * the starter class of framework
 *
 * Class Bootstrap
 * @package Anonym\Bootstrap
 */
class Bootstrap
{
    use Container;

    /**
     * bootstraps class repository
     *
     * @var array
     */
    private $constructors = [
        RequestConstructor::class,
        HandlerConstructor::class,
        ConfigConstructor::class,
        AliasConstructor::class,
        DatabaseConstructor::class,
    ];

    /**
     * the name of application
     *
     * @var string
     */
    private $name;

    /**
     * the version of application
     *
     * @var int
     */
    private $version;

    /**
     *
     * @param string name the name of framework application
     * @param int version the version of framework application
     *
     */
    public function __construct($name = '', $version = 1)
    {
        $this->name = $name;
        $this->version = $version;

        $this->resolveBootstraps();
        $this->resolveHelpers();
        $this->resolveProviders(Config::get('general.providers'));
    }

    /**
     *
     * include the helpers
     *
     */
    private function resolveHelpers()
    {
        $helpers = Config::get('general.helpers');

        if (count($helpers)) {
            foreach ($helpers as $helper) {
                if (file_exists($helper)) {
                    include $helper;
                }
            }
        }

    }
    /**
     *  resolve the constructor classes
     */
    private function resolveBootstraps()
    {
        $bootstraps = $this->constructors;
        foreach ($bootstraps as $boot) {
            if (is_string($boot)) {
                $app = $this;
                $this->bind(
                    $boot,
                    function () use ($boot, $app) {
                        return new $boot($app);
                    },
                    true
                );
            }
        }
    }

    /**
     * resolve the providers
     *
     * @throws ProviderException
     * @param array $providers
     */
    private function  resolveProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $provider = new $provider();

            if (!$provider instanceof ServiceProvider) {
                throw new ProviderException(sprintf('Your %s proiver must be a instance of ServiceProvider', get_class($provider)));
            }

            $provider->register();
        }

    }

}
