<?php

/**
 *  AnonymFramework Builders Select Trait -> where sorgular� burada olu�turulur
 *
 * @package Anonym\Database\Builders
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database\Builders;

use Anonym\Database\Traits\Where as WhereTrait;

/**
 * Class Where
 * @package Anonym\Database\Builders
 */
class Where
{

    use WhereTrait;

    /**
     * @param array $args
     * @param string $base
     * @return Ambigous <multitype:string , multitype:string multitype:array  >
     */
    public function where($args, $base)
    {

        if (is_array($args)) {

            return $this->databaseStringBuilderWithStart($args, ' AND');
        } else {
            return call_user_func($args, $base);
        }
    }

    /**
     * @param array $args
     * @param Base $base
     * @return Ambigous <multitype:string , multitype:string multitype:array  >
     */
    public function orWhere($args, $base)
    {

        if (is_array($args)) {

            return $this->databaseStringBuilderWithStart($args, ' OR');
        } else {

            return call_user_func($args, $base);
        }
    }
}
