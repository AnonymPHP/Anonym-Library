<?php

/**
 *  AnonymFramework Limit Builder -> limit sorgular� burada olu�tururlur
 *
 * @package  Anonym\Database\Builders;
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database\Builders;

/**
 * Class Limit
 * @package Anonym\Database\Builders
 */
class Limit
{

    public function limit($limit)
    {

        if (is_string($limit)) {

            $lArray = explode("..", $limit);
        }

        if (is_numeric($limit)) {

            $lArray = [$limit];
        }

        if (is_array($limit)) {

            $lArray = $limit;
        }

        if (count($lArray) == 2) {

            $limit = "{$lArray[0]},{$lArray[1]}";
        } else {
            $limit = "{$lArray[0]}";
        }

        return "LIMIT $limit";
    }
}
