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


class Model
{


    public function __construct()
    {
        $called = get_called_class();

        // if isset table variable
        if (array_key_exists('table', get_class_vars($called))) {

            // use it
            $called = get_class_vars($called)['table'];
        }



    }

}
