<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Mode;

/**
 * Class Advanced
 * @package Anonym\Database\Mode
 */
class Advanced extends ModeManager
{

    /**
     * determine table is exists
     */
    protected function tableExists(){
        $this->datas['tableExists'] = $this->datas['from'];
    }
}
