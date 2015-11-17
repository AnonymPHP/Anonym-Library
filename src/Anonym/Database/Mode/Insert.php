<?php

namespace Anonym\Database\Mode;

use Anonym\Database\Base;
use Anonym\Database\Traits\Where as TraitWhere;
use Anonym\Support\Arr;

/**
 * Class Insert
 * @package Anonym\Database\Mode
 */
class Insert extends ModeManager
{

    use TraitWhere;
    
    /**
     * Veritabanındaki role kısmının atamasını hazırlar
     *
     * @param array $role
     * @return mixed
     */
    public function role(array $role = [])
    {
        $role = implode(',', $role);

        return $this->set([
            'role' => $role
        ]);
    }


    /**
     * @param array $set
     * @return $this
     */
    public function set($set = [])
    {
        $this->datas['insert'][] = $set;
        return $this;
    }
}
