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

ini_set('display_errors', 'On');
use Anonym\Html\Form;

$form = new Form(false);
$form->open('test')
    ->input([
        'class' => 'input-sm',
        'placeholder' => 'Test'
    ]);


var_dump($form);