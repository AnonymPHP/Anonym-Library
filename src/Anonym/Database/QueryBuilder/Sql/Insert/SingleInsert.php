<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql;
use Anonym\Database\QueryBuilder\QueryBuilder;

/**
 * Class SingleInsert
 * @package Anonym\Database\QueryBuilder\Sql
 */
class SingleInsert extends  QueryBuilder
{

    /**
     * create a new instance and register pattern
     *
     * @param array $patterns
     */
    public function __construct($patterns = []){
        $this->pattern = $patterns['single'];
    }

    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery()
    {

    }
}
