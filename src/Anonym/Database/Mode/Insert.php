<?php

namespace Anonym\Components\Database\Mode;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Traits\Where as TraitWhere;

/**
 * Class Insert
 * @package Anonym\Components\Database\Mode
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

        $this->setChield($this);

        $this->setChieldPattern('insert');
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
