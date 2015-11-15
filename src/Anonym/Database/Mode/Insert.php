<?php

namespace Anonym\Database\Mode;

use Anonym\Database\Base;
use Anonym\Database\Traits\Where as TraitWhere;

/**
 * Class Insert
 * @package Anonym\Database\Mode
 */
class Insert extends ModeManager
{

    use TraitWhere;

    /**
     * Sınıfı başlatır
     *
     * @param Base $base
     */
    public function __construct(Base $base)
    {

        $this->setBase($base);

        $this->string = [
            'from' => $this->getBase()->getTable(),
            'insert' => null,
            'parameters' => [],
        ];

    }

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

        $insert = $this->databaseSetBuilder($set);
        $this->string['insert'] .= $insert['content'];
        $this->string['parameters'] = array_merge($this->string['parameters'], $insert['array']);

        return $this;
    }
}
