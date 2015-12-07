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
        'test' => json_encode(['aaa' => 'bb'])
    ],
    [
        'test' => 'required|json'
    ]);

$val->run();

var_dump($val);