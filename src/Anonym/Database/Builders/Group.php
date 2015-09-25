<?php

/**
 *  AnonymFramework Group Builder -> group burada oluştururlur
 *
 * @package  Anonym\Components\Database\Builders;
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Components\Database\Builders;

/**
 * Class Group
 * @package Anonym\Components\Database\Builders
 */
class Group
{

    /**
     *
     * Grup sorgusunu oluşturur
     * @param $group
     * @return string
     */
    public function group($group)
    {

        return "GROUP BY $group";
    }
}
