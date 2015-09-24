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

class WhereUpdate extends QueryBuilder
{

    /**
     * @var array
     */
    protected $where;

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
     * @return array
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param array $where
     * @return $this
     */
    public function setWhere($where)
    {
        $this->where = $where;
        return $this;
    }


    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery()
    {
        $update = $this->buildUpdateAndInsertSetter($this->parameters);

    }
}