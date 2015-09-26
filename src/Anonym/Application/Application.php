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

use Anonym\Constructors\RegisterErrorHandlers;
use Anonym\Constructors\DatabaseConstructor;
use Anonym\Constructors\RequestConstructor;
use Anonym\Constructors\ConfigConstructor;
use Illuminate\Container\Container;
use Anonym\Patterns\Facade;
use Closure;

/**
 * the starter class of framework
 *
 * Class Application
 * @package Anonym\Application
 */
class Application extends Container
{

    /**
     * Applications class repository
     *
     * @var array
     */
    private $constructors = [
        RegisterErrorHandlers::class,
        ConfigConstructor::class,
        DatabaseConstructor::class,
        RequestConstructor::class,
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
     * this callback will execute before application start
     *
     * @var Closure
     */
    protected $before;

    /**
     * this callback will execute after application start
     *
     * @var Closure
     */
    protected $after;

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


        $this->runApplicationWithEvents();

    }


    /**
     * run application with before and after events
     *
     *
     */
    protected function runApplicationWithEvents(){


        if (is_callable($before = $this->before)) {
            $before($this);
        }

        $this->readGeneralConfigsAndRegisterAliases();
        $this->resolveHelpers();
        $this->resolveApplications();

        if (is_callable($after = $this->after)) {
            $after($this->after);
        }
    }

    /**
     * register before callback
     *
     * @param Closure $before
     * @return $this
     */
    public function before(Closure $before){
        $this->before = $before;
        return $this;
    }

    /**
     * register after callback
     *
     * @param Closure $after
     * @return $this
     */
    public function after(Closure $after){
        $this->after = $after;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompiledPath()
    {
        return RESOURCE . 'Application/_compiled.php.cache';
    }

    /**
     * return the config files path
     *
     * @return mixed
     */
    public function getConfigPath(){
        return CONFIG;
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
        throw new HttpException($code, $message, $headers);
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
     * return system path
     *
     * @return mixed
     */
    public function getSystemPath(){
        return SYSTEM;
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
     * @return Application
     */
    public function setGeneral($general)
    {
        $this->general = $general;
        return $this;
    }

    /**
     *  resolve the constructor classes
     */
    private function resolveApplications()
    {
        $Applications = $this->constructors;
        foreach ($Applications as $boot) {
            if (is_string($boot)) {
                $this->singleton($boot, new $boot($this));
            }
        }
    }

}
