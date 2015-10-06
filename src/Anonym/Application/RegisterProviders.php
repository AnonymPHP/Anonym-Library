<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Application;

/**
 * Class RegisterProviders
 * @package Anonym\Application
 */
class RegisterProviders
{

    /**
     * the instance of application
     *
     * @var Application
     */
    private $app;


    /**
     * create a new instance and register application instance
     *
     * @param Application $app
     */
    public function __construct(Application $app){
        $this->app = $app;
    }

    /**
     * register the providers
     *
     * @throws ProviderException
     */
    public function register()
    {

        $app = $this->app;

        foreach ($app->getProviders() as $provider) {
            $provider = $app->make($provider, ['app' => $app]);

            if (!$provider instanceof ServiceProvider) {
                throw new ProviderException(sprintf('Your %s proiver must be a instance of ServiceProvider', get_class($provider)));
            }


            $provider->register();

            $app = $provider->app();
        }
    }

}