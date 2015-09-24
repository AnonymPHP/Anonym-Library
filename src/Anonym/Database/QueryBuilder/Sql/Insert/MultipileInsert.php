<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql\Insert;


use Anonym\Database\QueryBuilder\QueryBuilder;

/**
 * Class MultipileInsert
 * @package Anonym\Database\QueryBuilder\Sql\Insert
 */
class MultipileInsert extends QueryBuilder
{

    /**
     * @var array
     */
    protected $parameters;

    /**
     * create a new instance
     *
     * @param array $patterns
     * @param array $parameters
     * @param $table
     */
    public function __construct($patterns, $parameters, $table){
        $this->pattern = $patterns['multipile'];
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