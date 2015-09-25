<?php

/**
 *  AnonymFramework Builders Select Trait -> select sorgular� burada olu�turulur
 *
 * @package Anonym\Database\Builders
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database\Builders;

/**
 * Class Select
 * @package Anonym\Database\Builders
 */
class Select
{

    /**
     * Select sorgusunu oluşturur
     *
     * @param null $select
     * @param null $base
     * @return mixed|string
     */
    public function select($select = null, $base = null)
    {

        $s = '';
        ## değer dizi ise string e çeviriyoruz

        if (is_string($select)) {

            $s = str_replace(".", ",", $select);
        } elseif (is_array($select)) {

            foreach ($select as $sel) {

                if (is_string($sel)) {

                    $s .= $sel . ',';
                } elseif (is_callable($sel)) {
                    $s .= $this->selectCallable($select, $base);
                }
            }

            $s = rtrim($s, ",");
        } elseif (is_callable($select)) {

            $s = $this->selectCallable($select, $base);
        }

        return $s;
    }

    /**
     * @param mixed $select
     * @param mixed $base
     * @return string
     */
    private function selectCallable($select, $base)
    {

        $response = call_user_func_array($select, $base);
        $as = $response->getAs();
        $query = $response->getQuery();
        $select = "($query) as $as";

        return $select;
    }
}