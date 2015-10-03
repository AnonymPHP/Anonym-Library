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
use Anonym\Html\Form as Former;
/**
 * Class Form
 * @package Anonym\Facades
 */
class Form extends Facade
{

    /**
     * @return Form
     */
    protected static function getFacadeClass(){
        return new Former(Config::get('security.csrf.status'));
    }

}
