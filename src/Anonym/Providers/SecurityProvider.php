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

use GUMP;
use Anonym\Application\ServiceProvider;
use Anonym\Security\Authentication\Guard;
use Anonym\Security\CsrfToken;
use Anonym\Security\Firewall\Firewall\Firewall;
use Anonym\Security\TypeHint;
use Anonym\Facades\App;
use Anonym\Facades\Config;
use Anonym\Security\Firewall\IpFirewall;

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

        if (isset($all['firewall'])) {
            $this->registerFirewallSecurity($all['firewall']);
        }

        $this->prepareCsrfInstance();

        // register the type hint
        if (isset($all['type_hint'])) {
            if (true === $all['type_hint']) {
                $this->registerTypeHint();
            }
        }

        $this->filterGetParameters();

    }


    /**
     *  clean all query string
     */
    private function filterGetParameters()
    {

        if (!is_array($_GET)) {
            $_GET = [];
        }

        $_GET = GUMP::xss_clean($_GET);
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
     */
    private function prepareCsrfInstance(array $configs = [])
    {
        $configs = Config::get('security.csrf');

        $field = $configs['field_name'];
        $this->singleton(
            'security.csrf',
            function () use ($field) {
                return (new CsrfToken())->setFormFieldName($field);
            }
        );

    }
}
