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





}
