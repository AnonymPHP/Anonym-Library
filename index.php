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

$validation = new \Anonym\Validation\Validation([
   'test' => 'aaa'
], [
   'aa' => 'required'
], [
   'required.aa' => 'aa has to be exists'
]);

$validation->run();