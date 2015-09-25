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
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$paginator = new \Anonym\Components\Database\Pagination\Paginator([], 15, $_GET['page'], [
    'path' => 'http://localhost/Anonym-Database/index.php',
    'pageName' => 'page'
]);

$paginator->count(100);

$render = new \Anonym\Components\Database\Pagination\Render($paginator);

var_dump($render->simpleRendeArray());