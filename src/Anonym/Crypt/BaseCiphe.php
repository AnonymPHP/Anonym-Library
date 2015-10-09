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


class BaseCipher extends Cipher
{

    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function encode($value)
    {
        return base64_encode($value);
    }

    /**
     * decrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function decode($value)
    {
        return base64_decode($value);
    }
}