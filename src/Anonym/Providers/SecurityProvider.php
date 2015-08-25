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


use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\Security\CsrfToken;
use Anonym\Facades\Config;

/**
 * Class SecurityProvider
 * @package Anonym\Providers
 */
class SecurityProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $all = Config::get('security');

        if (isset($all['csrf'])) {
            $this->registerCsrfSecurity($all['csrf']);
        }

        if (isset($all['firewall'])) {
            $this->registerFirewallSecurity($all['firewall']);
        }
    }

    private function registerFirewallSecurity(array $firewall = [])
    {
        if (isset($firewall['ip_firewall'])) {
            $this->registerIpFirewall($firewall['ip_firewall']);
        }
    }



    /**
     * register the csrf token
     *
     * @param array $configs
     * @throws \Anonym\Bootstrap\BindNotFoundException
     * @throws \Anonym\Bootstrap\BindNotRespondingException
     */
    private function registerCsrfSecurity(array $configs = [])
    {

        if ($configs['status'] === true) {
            $field = $configs['field_name'];
            $this->bind(
                'security.csrf',
                function () use ($field) {
                    return (new CsrfToken())->setFormFieldName($field);
                }
            );

            $request = $this->make('http.request');

            if ($request->getMethod() === 'POST') {
                $this->make('security.csrf')->run();
            }
        }

    }
}
