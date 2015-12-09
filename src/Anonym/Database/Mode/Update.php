<?php

namespace Anonym\Database\Mode;

use Anonym\Database\Traits\Where as TraitWhere;
use Anonym\Support\Arr;

/**
 * Class Update
 * @package Anonym\Database\Mode
 */
class Update extends ModeManager
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
        $update = $this->databaseSetBuilder($set);
        $this->datas['update'][] = $update['content'];
        $this->datas['parameters'] = array_merge(Arr::get($this->datas, 'parameters', []), $update['array']);
        return $this;
    }
}
