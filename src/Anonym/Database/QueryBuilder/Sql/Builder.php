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
 * Class Builder
 * @package Anonym\Database\QueryBuilder
 */
class Builder extends QueryPatterns
{

    /**
     *  the constants for selected pattern
     */
    const WITH_WHERE = 1;
    const WITHOUT_WHERE = 0;


    /**
     * the constants for insert queries
     */
    const MULTIPILE_INSERT = 2;
    const SINGLE_INSERT = 3;

    /**
     * the mode of read
     *
     * @var int
     */
    protected $mode;

    /**
     * the values to query
     *
     * @var array
     */
    protected $values;



    public function insert(array $parameters = []){

        if (count($parameters) > 1 && isset($parameters[1])) {
            $mode = self::MULTIPILE_INSERT;
        }else{
            $mode = self::SINGLE_INSERT;
        }



    }

}
