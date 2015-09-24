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
    public function __construct($patterns, $parameters, $table){
        $this->prepareToBuild($patterns);
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

    }
}