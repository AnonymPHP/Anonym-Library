<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Console;
use Illuminate\Container\Container;

/**
 * Class Application
 * @package Anonym\Console
 */
class Application
{

    /**
     * @var array
     */
    protected $consoleConstructors;

    /**
     * @var Container
     */
    public static $container;

    public function __construct()
    {
    }

    /**
     * @return Container
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * @param Container $container
     */
    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

}