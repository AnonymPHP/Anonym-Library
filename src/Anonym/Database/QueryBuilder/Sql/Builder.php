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
use Anonym\Database\QueryBuilder\Sql\SingleInsert;
use Anonym\Database\QueryBuilder\Sql\MultipileInsert;
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
     * create a new instance and register container
     *
     * @param Container $container
     */
    public function __construct(Container $container){
        $this->container = $container;
    }

    /**
     * build a new insert query
     *
     * @param array $parameters
     * @return $this
     */
    public function insert(array $parameters = []){

        if (count($parameters) > 1 && isset($parameters[1])) {
            $mode = self::MULTIPILE_INSERT;
        }else{
            $mode = self::SINGLE_INSERT;
        }

        $instance = $this->container->make($mode, ['patterns' => $this->insert]);

        $this->query = $instance->buildQuery();
        return $this;
    }

}
