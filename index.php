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

$db = new \Anonym\Database\Base([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db'  => 'deneme'
], new \Illuminate\Container\Container());


$read = $db->read('test', function(\Anonym\Database\Mode\Read $read){
   return $read->where('test', 'ok')->orWhere('dest', 'adasd')->order('id');
});

$read->build();