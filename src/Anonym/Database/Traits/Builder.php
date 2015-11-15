<?php

namespace Anonym\Database\Traits;
/**
 * Trait Builder
 * @package Anonym\Database\Traits
 */
trait Builder
{

    private $tongueBuilders = [

    ];

    /**
     * create the a sql query
     *
     * @param array $pattern
     * @param array $args
     * @param string type
     * @return mixed
     */
    private function buildQuery($pattern, $args, $type)
    {


        if (count($args['parameters']) > 0) {

            $string = $pattern[0];
        } else {

            $string = $pattern[1];
        }

        if (preg_match_all("/:(\w+)/", $string, $match)) {

            $match = $match[0];
            $values = array_values($args);
            return str_replace($match, $values, $string);
        }
    }
}
