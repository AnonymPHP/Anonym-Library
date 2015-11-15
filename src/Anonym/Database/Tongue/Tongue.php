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


    /**
     * an array type for compareNames
     *
     * @var array
     */
    protected $compares = [
        "select",
        "join",
        "where",
        "update",
        "insert",
        "order",
        "limit"
    ];


    /**
     * an array type for prepared strings
     *
     * @var array
     */
    protected $strings;

    /**
     * starting the build query
     *
     * @param array $datas
     * @param string $type
     * @return mixed
     */
    public function build($datas, $type)
    {
        $this->datas = $datas;

        foreach ($this->compares as $compare) {
            if (isset($datas[$compare]) && !empty($datas[$compare])) {
                $method = 'compare'.ucfirst($compare);

                $this->$method($datas[$compare]);
            }
        }
    }


}
