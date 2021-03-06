<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Facades;

use Anonym\Filesystem\FilesystemManager as Filesystem;
use Anonym\Patterns\Facade;

/**
 * the facade of filesystem
 *
 * Class Filesystem
 * @package Anonym\Facades
 */
class Stroge extends Facade
{

    /**
     *  get the facade class
     * @return Filesystem
     */
    protected static function getFacadeClass()
    {
        $filesystem = new Filesystem();
        $filesystem->setConfig(Config::get('stroge.filesystem'));
        return $filesystem;
    }
}
