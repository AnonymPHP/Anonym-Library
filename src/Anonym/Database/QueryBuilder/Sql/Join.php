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


    /**
     * create a new instance and register parameters
     *
     * @param string $type
     * @param string $firstColumn
     * @param string $targetTable
     * @param string $targetColumn
     */
    public function __construct($type = 'INNER', $firstColumn, $targetTable, $targetColumn){
        $this->type($type);
        $this->home($firstColumn);
        $this->join($targetTable, $targetColumn);
    }

    /**
     * register the join type
     *
     * @param string $type
     * @return $this
     */
    public function type($type = 'INNER')
    {
        $this->type = $type;

        return $this;
    }

    /**
     * register the join home column variable
     *
     * @param string $column
     * @return $this
     */
    public function home($column = '')
    {
        $this->joinHomeColumn = $column;

        return $this;
    }

    /**
     * register join parameters
     *
     * @param string $table
     * @param string $column
     * @return $this
     */
    public function join($table, $column)
    {
        $this->joinedTable = $table;
        $this->joinerColumn = $column;

        return $this;
    }
}
