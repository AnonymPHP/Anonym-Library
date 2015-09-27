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
use Anonym\Support\Arr;
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
    protected function runApplicationWithEvents()
    {
        if ($this->before) {
            $this->runBeforeCallbacks();
        }

        // read configs/general.php for register aliases
        $this->readGeneralConfigs();

        // register all aliases
        $this->registerAliases();

        // register helpers;
        $this->resolveHelpers();

        // resolve bootstrap classes
        $this->resolveApplications();

        if ($this->after) {
            $this->runAfterCallbacks();
        }
    }

    /**
     * read configs/general.php for use aliases
     */
    private function readGeneralConfigs()
    {

        if (file_exists($path = $this->getConfigPath() . 'general.php')) {
            $this->setGeneral(include $path);
        }
    }

    /**
     *  register all aliases and alias loader
     */
    private function registerAliases()
    {

        // register this container to facades
        Facade::setApplication($this);


        $aliases = [

            'app' => ['Anonym\Application\Application', 'Illımunate\Container\Container'],
            'redirect' => ['Anonym\Http\Redirect'],
            'validation' => ['Anonym\Support\Validation'],
            'route' => ['Anonym\Route\RouteCollector'],
            'event' => ['Anonym\Event\EventDispatcher'],
            'cookie' => ['Anonym\Cookie\CookieInterface'],
            'session' => ['Anonym\Session\StrogeInterface'],
            'config' => ['Anonym\Config\Reposity'],
            'crypt' => ['Anonym\Crypt\Crypter']
        ];


        // register aliases
        foreach ($aliases as $key => $alias) {

            foreach ((array) $alias as $abstract) {
                $this->alias($abstract, $key);
            }
        }

        // register the alias loader
        $this->setAliasLoader(new AliasLoader(Arr::get($this->getGeneral(), 'alias')));
        $this->getAliasLoader()->register();
    }

    /**
     *  run defined before callbacks
     *
     */
    private function runBeforeCallbacks()
    {
        foreach ($this->before as $before) {
            if (is_callable($before)) {
                $before($this);
            }
        }
    }

    /**
     *  run defined after callbacks
     *
     */
    private function runAfterCallbacks()
    {
        foreach ($this->after as $after) {
            if (is_callable($after)) {
                $after($this);
            }
        }
    }

    /**
     * register before callback
     *
     * @param Closure $before
     * @return $this
     */
    public function before(Closure $before)
    {
        $this->before[] = $before;
        return $this;
    }

    /**
     * register after callback
     *
     * @param Closure $after
     * @return $this
     */
    public function after(Closure $after)
    {
        $this->after[] = $after;
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
    public function getConfigPath()
    {
        return CONFIG;
    }

    /**
     * return the application path
     *
     * @return mixed
     */
    public function getApplicationPath(){
        return APP;
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

        if(count($helpers = Arr::get($this->getGeneral(), 'helpers', []))){

            foreach($helpers as $helper){
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
    public function getSystemPath()
    {
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
