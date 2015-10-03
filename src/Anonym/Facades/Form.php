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
        return new Form(Config::get('security.csrf.status'));
    }

}
