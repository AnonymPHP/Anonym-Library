<?php

namespace Anonym\Components\Database\Mode;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Builders\Where;
use Anonym\Components\Database\Traits\Where as TraitWhere;

/**
 * Class Update
 * @package Anonym\Components\Database\Mode
 */
class Update extends ModeManager
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

        $this->useBuilders([
            'where' => new Where()
        ]);

        $this->string = [

            'from' => $this->getBase()->getTable(),
            'update' => null,
            'where' => null,
            'parameters' => [],
        ];

        $this->setChield($this);

        $this->setChieldPattern('update');
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

        $update = $this->databaseSetBuilder($set);
        $this->string['update'] .= $update['content'];
        $this->string['parameters'] = array_merge($this->string['parameters'], $update['array']);

        return $this;
    }
}
