<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql\Select;

use Anonym\Database\QueryBuilder\Sql\Join;
use Anonym\Database\QueryBuilder\QueryBuilder;

/**
 * Class SelectWithAll
 * @package Anonym\Database\QueryBuilder\Sql\Select
 */
class SelectWithAll extends QueryBuilder
{

    /**
     * create a new instance
     *
     * @param array $patterns
     * @param array $parameters
     * @param $table
     */
    public function __construct($patterns, $parameters, $table)
    {
        $this->prepareToBuild($patterns, $parameters);
        $this->parameters = $parameters;
        $this->table = $table;
    }


    /**
     * prepare pattern to build
     *
     * @param array $patterns
     * @param array $parameters
     */
    protected function prepareToBuild($patterns, $parameters)
    {
        if (null !== $parameters['where']) {
            $this->pattern = $patterns['with_where'];
        } else {
            $this->pattern = $parameters['without_where'];
        }
    }

    /**
     *
     * Grup sorgusunu oluşturur
     * @param $group
     * @return string
     */
    protected function prepareGroup($group)
    {

        return "GROUP BY $group";
    }

    /**
     * prepare limit query
     *
     * @param mixed $limit
     * @return string
     */
    protected function prepareLimit($limit)
    {
        if (is_string($limit)) {

            $limit = explode(',', $limit);
        }

        if (count($limit) === 1) {
            return "LIMIT {$limit[0]}";
        } else {
            return "LIMIT " . join(',', $limit);
        }
    }

    /**
     * prepare order parameter
     *
     * @param array $order
     * @return string
     */
    protected function prepareOrder($order)
    {
        list($column, $type) = $order;

        $type = strtoupper($type);
        return "ORDER BY $column $type";
    }

    /**
     * prepare join parameter to query
     *
     * @param Join $join
     * @return string
     */
    protected function prepareJoin(Join $join)
    {

        $type = $join->type . ' JOIN';

        return sprintf("%s %s ON %s.%s = %s.%s", $type, $this->table, $this->table, $join->joinHomeColumn, $join->joinedTable, $join->joinerColumn);
    }

    /**
     * prepare select query
     *
     * @param string|array $select
     * @return string
     */
    protected function prepareSelect($select){
        if (is_array($select)) {
            $select = join(',', $select);
        }

        return $select;
    }
    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery()
    {

        $parameters = $this->parameters;

        $replace = [
            ':select' => $parameters['select'] ? $this->prepareSelect($parameters['select']) : '*',
            ':from'   => $this->table,
            ':group'  => $parameters['group']  ? $this->prepareGroup($parameters['group']) : '',
            ':join'   => $parameters['join'] instanceof Join ? $this->prepareJoin($parameters['join']): '',
            ':order'  => $parameters['order'] ? $this->prepareOrder($parameters['order']) : '',
            ':limit'   => $parameters['limit'] ? $this->prepareLimit($parameters['limit']) : ''
        ];

        if(is_array($parameters['where'])){
            $replace[':where'] = $this->buildWhereQuery($parameters['where']);
        }

        return $this->replacePattern($replace);
    }
}
