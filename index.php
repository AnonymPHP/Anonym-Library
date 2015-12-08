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

$database = new \Anonym\Database\Base([
    'host' => 'localhost',
    'db' => 'deneme',
    'username' => 'root',
    'password' => ''
],new \Illuminate\Container\Container());

$advanced = $database->advanced('test', function(\Anonym\Database\Mode\Advanced $advanced){
   return $advanced->columnExists('username');
});

var_dump($advanced);