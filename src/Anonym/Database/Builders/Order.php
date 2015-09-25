<?php

/**
 *  AnonymFramework Builders Order Trait -> order sorgular� burada olu�turulur
 *
 * @package Anonym\Components\Database\Builders
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Components\Database\Builders;

/**
 * Class Order
 * @package Anonym\Components\Database\Builders
 */
class Order
{

    /**
     * Order metnini oluşturur
     *
     * @param $id
     * @param string $type
     * @return string
     */
    public function order($id, $type = 'DESC')
    {

        return "ORDER BY {$id} {$type}";
    }
}
