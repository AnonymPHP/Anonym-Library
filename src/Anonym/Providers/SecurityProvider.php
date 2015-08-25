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
    }

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
