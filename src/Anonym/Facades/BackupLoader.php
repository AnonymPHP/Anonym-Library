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

use Anonym\Patterns\Facade;
use Anonym\Database\Tools\Backup\Load;
use Anonym\Patterns\Singleton;

/**
 * Class BackupLoader
 * @package Anonym\Facades
 */
class BackupLoader extends Facade
{

    /**
     * get the loader facade
     *
     *
     * @return Load
     */
    protected static function getFacadeClass()
    {
        return new Load(Singleton::bind('database.base'));
    }

}
