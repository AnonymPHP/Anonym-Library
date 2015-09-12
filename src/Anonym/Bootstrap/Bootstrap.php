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
use Anonym\Constructors\HandlerConstructor;
use Anonym\Constructors\ConfigConstructor;
use Anonym\Constructors\AliasConstructor;
use Illuminate\Container\Container;
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
        AliasConstructor::class,
        DatabaseConstructor::class,
        HandlerConstructor::class,
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
     *
     * @param string name the name of framework application
     * @param int version the version of framework application
     *
     */
    public function __construct($name = '', $version = 1)
    {
        $this->name = $name;
        $this->version = $version;

        $this->readGeneralConfigs();
        $this->resolveHelpers();
        $this->resolveBootstraps();

    }

    /**
     * throw an http exception with given datas
     *
     * @param int $code
     * @param string $message
     * @param array $headers
     * @throws HttpException
     */
    public function abort($code = 503, $message = '', array $headers  = []){
        throw new HttpException($code, $message, null, $headers);
    }

    /**
     * read default configs
     */
    private function readGeneralConfigs()
    {
        $configs = include(CONFIG. 'general.php');
        $this->setGeneral($configs);
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
                new $boot($this);
            }
        }
    }

}
