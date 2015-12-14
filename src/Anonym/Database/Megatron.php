<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;


class Megatron
{


    /**
     * handle and execute class vars
     */
    protected function handleClassVars()
    {

        // set selected columns
        if (isset($this->vars['select'])) {
            $this->getQueryBuilder()->select($this->vars['select']);
        }
    }
}