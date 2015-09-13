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
use Anonym\Components\Security\Authentication\Guard;
use Anonym\Components\Security\CsrfToken;
use Anonym\Components\Security\Firewall\Firewall\Firewall;
use Anonym\Components\Security\TypeHint;
use Anonym\Facades\App;
use Anonym\Facades\Config;
use Anonym\Components\Security\Firewall\IpFirewall;

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

        // register the type hint
        if (isset($all['type_hint'])) {
            if (true === $all['type_hint']) {
                $this->registerTypeHint();
            }
        }

    }


    /**
     * register the type hint
     *
     */
    private function registerTypeHint()
    {
        TypeHint::boot();
    }

    /**
     * register the firewall
     *
     * @param array $firewall
     */
    private function registerFirewallSecurity(array $firewall = [])
    {

        if (true === $firewall['status']) {
            if (isset($firewall['ip_firewall'])) {
                $this->registerIpFirewall($firewall['ip_firewall']);
            }

            if (isset($firewall['full_firewall'])) {
                $this->registerFullFirewall($firewall['full_firewall']);
            }
        }

    }

    /**
     * register the full firewall
     *
     * @param array $firewall
     * @throws \Anonym\Components\Security\Exception\ClassInstanceException
     * @throws \Anonym\Components\Security\Exception\FirewallException
     */
    private function registerFullFirewall(array $firewall = [])
    {
        $firewall = new Firewall($firewall);
        $firewall->run();
    }

    /**
     * register the ip list to firewall
     *
     * @param array $ipList
     */
    private function registerIpFirewall(array $ipList = [])
    {
        $firewall = new IpFirewall();
        $firewall->setIpAddress($ipList)->handle();
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
            App::singleton(
                'security.csrf',
                function () use ($field) {
                    return (new CsrfToken())->setFormFieldName($field);
                }
            );

            $request = App::make('http.request');

            if ($request->getMethod() === 'POST') {
                App::make('security.csrf')->run();
            }
        }

    }
}
