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

use Anonym\Facades\Config;
/**
 * Class RegisterProviders
 * @package Anonym\Application
 */
class RegisterProviders
{

    /**
     * create a new instance
     *
     * @param Application $app
     * @throws ProviderException
     */
    public function __construct(Application &$app)
    {

        $providers = Config::get('general.providers');

        foreach ($providers as $provider) {
            $provider = new $provider();

            if (!$provider instanceof ServiceProvider) {
                throw new ProviderException(sprintf('Your %s proiver must be a instance of ServiceProvider', get_class($provider)));
            }

            $provider->setApp($app);

            $provider->register();
        }
    }

}