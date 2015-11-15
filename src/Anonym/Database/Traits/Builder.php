<?php

namespace Anonym\Database\Traits;
use Anonym\Database\Tongue\MysqlTongue;
use Anonym\Database\Tongue\MssqlTongue;
use Anonym\Database\Tongue\PgsqlTongue;
use Anonym\Database\Base;

/**
 * Trait Builder
 * @package Anonym\Database\Traits
 */
trait Builder
{

    private $tongueBuilders = [
        Base::TYPE_MYSQL => MysqlTongue::class,
        Base::TYPE_MSSQL => MssqlTongue::class,
        Base::TYPE_PGSQL => PgsqlTongue::class
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
