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
 * Class QueryPatterns
 * @package Anonym\Database\QueryBuilder
 */
class QueryPatterns
{

    /**
     * the pattern to select queries
     *
     * @var array
     */
    protected $selectPattern = [

        'with_where' => 'SELECT :select FROM :from :join :group WHERE:where :order :limit',
        'without_where' => 'SELECT :select FROM :from :join :group :order :limit'
    ];


    /**
     * the patterns to delete queries
     *
     * @var array
     */
    protected $delete = [
        'with_where' => 'DELETE FROM :from WHERE:where',
        'without_where' => 'DELETE FROM :from'
    ];

    /**
     * the patterns to update queries
     *
     * @var array
     */
    protected $update = [
        'with_where' => 'UPDATE :from SET :update WHERE:where',
        'without_where' => 'UPDATE :from SET :update'
    ];

    /**
     * the patterns to insert queries
     *
     * @var array
     */
    protected $insert = [
        'single' => 'INSERT INTO :from SET :insert',
        'multipile' => 'INSERT INTO :from (:clms) VALUES (:values)'
    ];
}
