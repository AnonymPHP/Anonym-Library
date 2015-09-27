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

use Illuminate\Container\Container;
$container = new Container();

$container->alias(PHPMailer::class, 'mailer');
$mailer = $container->make('mailer');

var_dump($mailer);