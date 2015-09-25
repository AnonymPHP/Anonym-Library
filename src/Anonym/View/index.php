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

$view = new \Anonym\Components\View\View([
    'cache' => 'cache',
    'view'  => 'views'
]);


$factory = $view->make('index');
