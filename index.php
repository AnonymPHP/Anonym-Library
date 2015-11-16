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


$update = $db->update('deneme', function(\Anonym\Database\Mode\Update $update){
   return $update->set([
      'test' => 'value',
      'test1' => 'value2'
   ]);
});

$update->build();