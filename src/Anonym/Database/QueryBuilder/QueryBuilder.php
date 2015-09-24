<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder;


/**
 * Interface QueryBuilderInterface
 * @package Anonym\Database\QueryBuilder
 */
abstract class QueryBuilder
{

    /**
     * the pattern to query
     *
     * @var string
     */
    protected $pattern;

    /**
     * the name of table
     *
     * @var string
     */
    protected $table;

    /**
     * the parameters
     *
     * @var array
     */
    protected $parameters;
    /**
     * build and return query string
     *
     * @return string
     */
    abstract public function buildQuery();

    /**
     * build sql query string to update and insert methods
     *
     * @param array $parameters
     * @return string
     */
    protected function buildUpdateAndInsertSetter(array $parameters)
    {
        $builded = '';

        foreach ($parameters as $key => $value) {
            $builded .= "$key = $value,";
        }

        return rtrim($builded, ',');
    }

    /**
     * replace pattern string with given datas
     *
     * @param array $datas
     * @return string
     */
    protected function replacePattern(array $datas)
    {
        $search = array_keys($datas);
        $replaceWith = array_values($datas);

        return str_replace($search, $replaceWith, $this->pattern);
    }

    /**
     * build where query
     *
     * @param array $queries
     * @param string $mode
     * @return string
     */
    protected function buildWhereQuery($queries, $mode = 'AND'){

        $builded = '';

        foreach ($queries as $key => $value) {
            $builded .= "$key = $value $mode";
        }


        return rtrim($builded, $mode);
    }
}
