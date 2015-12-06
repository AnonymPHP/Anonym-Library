<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

include 'vendor/autoload.php';

$val = new \Anonym\Validation\Validation(
    [
        'test' => 'asdasdasd'
    ],
    [
        'test' => 'required|numeric'
    ],
    [
        'numeric.test' => ':key must be a numeric data'
    ]);

$val->run();

var_dump($val);