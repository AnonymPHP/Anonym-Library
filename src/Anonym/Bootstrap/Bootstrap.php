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
use Anonym\Constructors\HelpersConstructor;
use Anonym\Constructors\ConfigConstructor;
use Anonym\Constructors\AliasConstructor;
use Anonym\Bootstrap\RegisterProviders;

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
        AliasConstructor::class,
        ConfigConstructor::class,
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
     *
     * @param string name the name of framework application
     * @param int version the version of framework application
     *
     */
    public function __construct($name = '', $version = 1)
    {
        $this->name = $name;
        $this->version = $version;

        $this->resolveHelpers();
        $this->resolveBootstraps();
    }

    /**
     * resolve the helpers
     */
    private function resolveHelpers()
    {
        $helpers = include(CONFIG.'general.php');
        $helpers = $helpers['helpers'];

        if (count($helpers)) {
            foreach ($helpers as $helper) {
                if (file_exists($helper)) {
                    include $helper;
                }
            }
        }
    }

    /**
     *  resolve the constructor classes
     */
    private function resolveBootstraps()
    {
        $bootstraps = $this->constructors;
        foreach ($bootstraps as $boot) {
            if (is_string($boot)) {
                $app = $this;
                $this->bind(
                    $boot,
                    function () use ($boot, $app) {
                        return new $boot($app);
                    },
                    true
                );
            }
        }
    }

}
