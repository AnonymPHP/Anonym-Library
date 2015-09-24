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
 * Class SingleInsert
 * @package Anonym\Database\QueryBuilder\Sql
 */
class SingleInsert extends  QueryBuilder
{

    /**
     *
     * @var array
     */
    protected $parameters;

    /**
     * create a new instance and register pattern
     *
     * @param array $patterns
     * @param array $parameters
     * @param string $table
     */
    public function __construct($patterns = [],array $parameters = [], $table){
        $this->pattern = $patterns['single'];
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
