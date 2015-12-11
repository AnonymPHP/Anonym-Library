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

$base = new \Anonym\Database\Base([
    'host' => 'localhost',
    'dbname' => 'deneme',
    'username' => 'root',
    'password' => ''
],new \Illuminate\Container\Container());

\Anonym\Database\Database::setDatabaseApplication($base);

$database = new \Anonym\Database\Database();