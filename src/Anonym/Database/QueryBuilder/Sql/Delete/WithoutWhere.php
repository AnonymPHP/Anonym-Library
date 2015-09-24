<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql\Delete;


use Anonym\Database\QueryBuilder\QueryBuilder;

/**
 * Class WithoutWhere
 * @package Anonym\Database\QueryBuilder\Sql\Delete
 */
class WithoutWhere extends QueryBuilder
{

    /**
     * create a new instance
     *
     * @param array $patterns
     * @param string $table
     */
    public function __construct($patterns, $table){
        $this->pattern = $patterns['without_where'];
        $this->table = $table;
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
