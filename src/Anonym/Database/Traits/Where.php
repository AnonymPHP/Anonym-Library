<?php

namespace Anonym\Components\Database\Traits;

/**
 * Class Where
 * @package Anonym\Components\Database\Traits
 */
trait Where
{

    /**
     *
     * @param array $args
     * @param string $start
     * @return mixed
     */
    private function databaseStringBuilderWithStart(array $args, $start)
    {

        $s = '';
        $arr = [];

        foreach ($args as $arg) {

            $s .= " {$arg[0]} {$arg[1]} ? $start";
            $arr[] = $arg[2];
        }

        if (!count($args) === 1) {

            $s = $start . $s;
        }

        $s = rtrim($s, $start);

        return [

            'content' => $s,
            'array' => $arr,
        ];
    }

    /**
     * Set verisi oluşturur
     *
     * @param mixed $set
     * @return multitype:string multitype:array
     */
    private function databaseSetBuilder($set)
    {

        $s = '';
        $arr = [];

        foreach ($set as $key => $value) {
            $s .= "$key = ?,";
            $arr[] = $value;
        }

        return [

            'content' => rtrim($s, ","),
            'array' => $arr,
        ];
    }
}
