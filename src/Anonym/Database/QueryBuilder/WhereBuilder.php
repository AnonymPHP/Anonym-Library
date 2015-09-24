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
 * Class WhereBuilder
 * @package Anonym\Database\QueryBuilder
 */
class WhereBuilder
{

    public function buildWhereQuery($where = []){

        if(is_object($where)){
            $where = (array) $where;
        }



    }

}
