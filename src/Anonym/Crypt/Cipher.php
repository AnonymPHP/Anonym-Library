<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Crypt;

/**
 * Class Cipher
 * @package Anonym\Crypt
 */
abstract class Cipher
{

    abstract public function encode($value);

    abstract public function decode($value);
}
