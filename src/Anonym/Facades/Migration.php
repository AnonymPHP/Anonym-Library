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

use Anonym\Components\Tools\MigrationManager;
use Anonym\Patterns\Facade;
use Anonym\Patterns\Singleton;

/**
 * the facade of migration
 *
 * Class Migration
 * @package Anonym\Facades
 */
class Migration extends Facade
{

    /**
     * get the migration facade
     *
     *
     * @return MigrationManager
     */
    protected static function getFacadeClass()
    {
        return new MigrationManager(Singleton::bind('database.base'));
    }
}
