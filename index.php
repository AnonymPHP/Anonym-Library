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

$container = new \Illuminate\Container\Container();
$builder = new Anonym\Database\QueryBuilder\Sql\Builder($container);

$builder->table('users')->orWhere('key', 'value')->where('aa', 'bb')->group('test')->orderBy('id', 'DESC');



print_r($builder->get());