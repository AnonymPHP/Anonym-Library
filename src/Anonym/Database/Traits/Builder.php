<?php

namespace Anonym\Components\Database\Traits;

/**
 * Trait Builder
 * @package Anonym\Components\Database\Traits
 */
trait Builder
{

    /**
     * create the a sql query
     *
     * @param array $pattern
     * @param array $args
     * @return mixed
     */
    private function buildQuery($pattern, $args)
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
