<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Database\QueryBuilder;


/**
 * Interface QueryBuilderInterface
 * @package Anonym\Database\QueryBuilder
 */
interface QueryBuilderInterface
{

    /**
     * build and return query string
     *
     * @return string
     */
    public function buildQuery();

}
