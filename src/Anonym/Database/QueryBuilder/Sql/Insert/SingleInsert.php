<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder\Sql;

/**
 * Class SingleInsert
 * @package Anonym\Database\QueryBuilder\Sql
 */
class SingleInsert
{

    /**
     * the pattern string
     *
     * @var string
     */
    protected $pattern;

    /**
     * create a new instance and register pattern
     *
     * @param array $patterns
     */
    public function __construct($patterns = []){
        $this->pattern = $patterns['single'];
    }

}
