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

use Anonym\Support\Str;

/**
 * Class WhereBuilder
 * @package Anonym\Database\QueryBuilder
 */
class WhereBuilder
{

    public function buildWhereQuery($where = [])
    {

        $builded = '';

        if (is_object($where)) {
            $where = (array)$where;
        }

        foreach ($where as $w) {

            list($column, $operator, $value, $mode) = $w;
            $builded .= "$column $operator $value $mode";
        }


        if (Str::endsWith($builded, 'AND')) {
            $builded = rtrim($builded, 'AND');
        } elseif (Str::endsWith($builded, 'OR')) {
            $builded = rtrim($builded, 'OR');
        }

    }

}
