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
    protected function buildUpdateAndInsertSetter(array $parameters){
        $builded  = '';

        foreach($parameters as $key => $value){
            $builded .= "$key = $value,";
        }

        return rtrim($builded,',');
    }
}
