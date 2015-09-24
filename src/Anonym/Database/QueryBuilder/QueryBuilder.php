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
     * build and return query string
     *
     * @return string
     */
    abstract public function buildQuery();

}
