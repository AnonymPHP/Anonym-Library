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


class Join
{

    /**
     * the type of joiner
     *
     * @var string
     */
    public $type = 'INNER';


    /**
     * the table name of joiner table
     *
     * @var string
     */
    public $joinedTable;


    /**
     * the column name
     *
     * @var string
     */
    public $joinHomeColumn;


    /**
     * the column name of joiner table
     *
     * @var string
     */
    public $joinerColumn;
}
