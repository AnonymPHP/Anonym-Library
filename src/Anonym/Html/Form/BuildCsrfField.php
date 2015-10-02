<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Html\Form;

use Anonym\Facades\Config;
use Anonym\Facades\Csrf;

/**
 * Class BuildCsrfField
 * @package Anonym\Html\Form
 */
trait BuildCsrfField
{

    /**
     * return csrf token
     *
     * @return mixed
     */
    public function createToken(){
        return Csrf::getToken();
    }

    public function createCsrfField(){
        $fieldName = Config::get('security.csrf.field_name');


    }
}