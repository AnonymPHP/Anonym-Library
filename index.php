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

$openssl = new \Anonym\Crypt\OpenSslCipher('aaa');


var_dump($enc = $openssl->encode('aaatest'));

var_dump($openssl->decode($enc));