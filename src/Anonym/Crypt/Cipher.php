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

    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    abstract public function encode($value);

    /**
     * decrypt the value
     *
     * @param string $value
     * @return mixed
     */
    abstract public function decode($value);
}
