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

use Anonym\Constructors\DatabaseConstructor;
use Anonym\Constructors\RequestConstructor;
use Anonym\Constructors\ConfigConstructor;
use Anonym\Application\AliasLoader;
use Illuminate\Container\Container;
use Anonym\Patterns\Facade;
use HttpException;

/**
 * the starter class of framework
 *
 * Class Bootstrap
 * @package Anonym\Bootstrap
 */
class Bootstrap extends Container
{

    /**
     * bootstraps class repository
     *
     * @var array
     */
    private $constructors = [
        RequestConstructor::class,
        ConfigConstructor::class,
        DatabaseConstructor::class,
        RegisterProviders::class
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
     * the general configs
     *
     * @var array
     */
    private $general;

    /**
     * the alias loader
     *
     * @var AliasLoader
     */
    private $aliasLoader;

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

        $this->readGeneralConfigsAndRegisterAliases();
        $this->resolveHelpers();
        $this->resolveBootstraps();
    }


    /**
     * @return string
     */
    public function getCompiledPath()
    {
        return RESOURCE . 'bootstrap/_compiled.php.cache';
    }

    /**
     * throw an http exception with given datas
     *
     * @param int $code
     * @param string $message
     * @param array $headers
     * @throws HttpException
     */
    public function abort($code = 503, $message = '', array $headers = [])
    {
        throw new HttpException($code, $message, null, $headers);
    }

    /**
     * read default configs
     */
    private function readGeneralConfigsAndRegisterAliases()
    {
        $configs = include(CONFIG . 'general.php');
        $this->setGeneral($configs);
        $aliases = $configs['alias'];
        $this->setAliasLoader(new AliasLoader($aliases));

        $lower = [];
        foreach ($aliases as $key => $value) {
            $lower[strtolower($key)] = $value;
        }

        foreach ($lower as $alias => $values) {
            $values = (array)$values;

            foreach ($values as $value) {
                $this->getAliasLoader()->alias($alias, $value);
            }
        }

        Facade::setApplication($this);
        $this->getAliasLoader()->register();
    }

    /**
     * @return AliasLoader
     */
    public function getAliasLoader()
    {
        return $this->aliasLoader;
    }

    /**
     * @param AliasLoader $aliasLoader
     */
    public function setAliasLoader($aliasLoader)
    {
        $this->aliasLoader = $aliasLoader;
    }


    /**
     * resolve the helpers
     */
    private function resolveHelpers()
    {
        $helpers = $this->getGeneral()['helpers'];

        if (count($helpers)) {
            foreach ($helpers as $helper) {
                if (file_exists($helper)) {
                    include $helper;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * @param array $general
     * @return Bootstrap
     */
    public function setGeneral($general)
    {
        $this->general = $general;
        return $this;
    }

    /**
     *  resolve the constructor classes
     */
    private function resolveBootstraps()
    {
        $bootstraps = $this->constructors;
        foreach ($bootstraps as $boot) {
            if (is_string($boot)) {
                $this->singleton($boot, new $boot($this));
            }
        }
    }

}
