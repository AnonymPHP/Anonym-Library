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

use Illuminate\Container\Container;
use Anonym\Database\QueryBuilder\Sql\Insert\SingleInsert;
use Anonym\Database\QueryBuilder\Sql\Insert\MultipileInsert;

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
    const MULTIPILE_INSERT = MultipileInsert::class;
    const SINGLE_INSERT = SingleInsert::class;

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

    /**
     * the instance container
     *
     * @var Container
     */
    protected $container;

    /**
     * the query
     *
     * @var string
     */
    protected $query;

    /**
     * the name of selected table
     *
     * @var string
     */
    protected $table;

    /**
     * the parameters to prepared statements
     *
     * @var array
     */
    protected $preparedParameters;

    /**
     * create a new instance and register container
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * select the selected table
     *
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * build a new insert query
     *
     * @param array $parameters
     * @return $this
     */
    public function insert(array $parameters = [])
    {


        if (count($parameters) > 1 && isset($parameters[1])) {
            $mode = self::MULTIPILE_INSERT;
        } else {
            $mode = self::SINGLE_INSERT;
        }

        $this->preparedParameters = array_values($parameters);

        $instance = $this->container->make($mode, ['patterns' => $this->insert, 'parameters' => $parameters, 'table' => $this->table]);

        $this->query = $instance->buildQuery();
        return $this;
    }

}
