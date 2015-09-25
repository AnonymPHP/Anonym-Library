<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Element\Query\Grammer;


abstract class Grammer
{

    /**
     * compile all insert values with special grammer
     *
     * @param array $values
     * @return mixed
     */
    abstract public function compileInsertValues(array $values = []);


    /**
     * compile all update values with special grammer
     *
     * @param array $values
     * @return mixed
     */
    abstract public function compileUpdateValues(array $values = []);


    /**
     * compile all where values with special grammer
     *
     * @param array $values
     * @return mixed
     */
    abstract public function compileWhereValues(array $values = []);

}