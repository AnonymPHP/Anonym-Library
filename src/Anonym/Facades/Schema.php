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
use Anonym\Tools\Schema as SchemaInstance;
use Anonym\Patterns\Singleton;

/**
 * Class Schema
 * @package Anonym\Facades
 */
class Schema extends Facade
{

    /**
     * get the schema facade
     *
     * @return SchemaInstance
     */
    protected static function getFacadeClass()
    {
        return new SchemaInstance(App::make('database.base'));
    }
}
