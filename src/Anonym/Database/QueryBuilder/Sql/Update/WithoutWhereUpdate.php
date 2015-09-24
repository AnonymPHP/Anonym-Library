<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql\Update;

use Anonym\Database\QueryBuilder\QueryBuilder;

/**
 * Class WithoutWhereUpdate
 * @package Anonym\Database\QueryBuilder\Sql\Update
 */
class WithoutWhereUpdate extends QueryBuilder
{

    /**
     * create a new instance
     *
     * @param array $patterns
     * @param array $parameters
     * @param string $table
     */
    public function __construct($patterns, array $parameters = [], $table){
        $this->pattern = $patterns['without_where'];
        $this->parameters = $parameters;
        $this->table = $table;
    }

    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery()
    {

        $update = $this->buildUpdateAndInsertSetter($this->parameters);

        $builded = $this->replacePattern([
            ':from' => $this->table,
            ':update' => $update
        ]);

        return $builded;
    }
}
