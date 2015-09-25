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
use Anonym\Tools\Backup as BackupDispatcher;
use Anonym\Patterns\Singleton;

/**
 * Class Backup
 * @package Anonym\Facades
 */
class Backup extends Facade
{

    /**
     *
     * get the backup facade
     *
     * @return BackupDispatcher
     */
    protected static function getFacadeClass()
    {
        return new BackupDispatcher(App::make('database.base'));
    }
}
