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


echo $form->open();
$select = $form->select();

for($i = 0; $i<= 100; $i++){
    $select->value($i, $i. 'content');
}

var_dump($select->execute());

echo $form->close();