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
 * Class WithWhere
 * @package Anonym\Database\QueryBuilder\Sql\Delete
 */
class WithWhere extends QueryBuilder
{

    /**
     * the where parameters
     *
     * @var array
     */
    protected $where;

    /**
     * create a new instance
     *
     * @param array $patterns
     * @param string $table
     */
    public function __construct($patterns, $where, $table)
    {
        $this->pattern = $patterns['with_where'];
        $this->where = $where;
        $this->table = $table;
    }

    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery()
    {
        return $this->replacePattern([
            ':from' => $this->table,
            ':where' => $this->buildWhereQuery($this->where));
    }
}
