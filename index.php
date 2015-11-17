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


$insert = $db->insert('deneme', function(\Anonym\Database\Mode\Insert $insert){
   return $insert->set([
      'aaa' => 'bbb',
      'ddd' => 'ccc'
   ])->set([
      'aaa' => 'ccc',
      'ddd' => 'eee'
   ]);
});


var_dump($insert->build());