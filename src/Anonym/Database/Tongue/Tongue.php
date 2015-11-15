<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Tongue;


/**
 * Class Tongue
 * @package Anonym\Database\Tongue
 */
abstract class Tongue
{

    /**
     * an array type for build query
     *
     * @var array
     */
    protected $datas;


    protected $compares = [
        "select",
        "where",
        "update",
        "insert",
        "order",
        "limit"
    ];

    /**
     * starting the build query
     *
     * @param array $datas
     * @return mixed
     */
    public function build($datas)
    {
        $this->datas = $datas;
    }


}
