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

$mcrypt = new \Anonym\Crypt\McryptCipher('anonymphp');

$encoded = $mcrypt->encode('aa');

var_dump($encoded);