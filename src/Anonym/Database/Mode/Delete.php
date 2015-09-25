<?php

/**
 *  AnonymFramework Delete Builder -> delete sorgular� haz�rlan�r
 *
 * @package  Anonym\Components\Database\Mode;
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @copyright (c) 2015, MyfcYazilim
 */

namespace Anonym\Components\Database\Mode;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Builders\Where;

/**
 * Class Delete
 * @package Anonym\Components\Database\Mode
 */
class Delete extends ModeManager
{

    /**
     * Sınıfı başlatır
     *
     * @param Base $base
     */
    public function __construct(Base $base)
    {

        $this->setBase($base);
        $this->useBuilders([

            'where' => new Where(),
        ]);

        $this->string = [

            'from' => $this->getBase()->getTable(),
            'where' => null,
            'parameters' => [],
        ];

        $this->setChield($this);

        $this->setChieldPattern('delete');
    }
}
