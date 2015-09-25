<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Constructor;
use Anonym\Facades\Config;
/**
 * Class RegisterProviders
 * @package Anonym\Bootstrap
 */
class RegisterProviders
{

    /**
     * create a new instance
     *
     * @param Bootstrap $app
     * @throws BindNotRespondingException
     * @throws ProviderException
     */
    public function __construct(Bootstrap $app)
    {

        $providers = Config::get('general.providers');

        foreach ($providers as $provider) {
            $provider = new $provider();

            if (!$provider instanceof ServiceProvider) {
                throw new ProviderException(sprintf('Your %s proiver must be a instance of ServiceProvider', get_class($provider)));
            }

            $provider->register();
        }
    }

}