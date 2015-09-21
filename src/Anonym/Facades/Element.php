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
use Anonym\Components\Element\Model;

/**
 * Class Element
 * @package Anonym\Facades
 */
class Element extends Facade{

    /**
     * return facade instance or class name
     *
     * @return mixed
     */
    protected static function getFacadeClass(){
        return Model::class;
    }


}
