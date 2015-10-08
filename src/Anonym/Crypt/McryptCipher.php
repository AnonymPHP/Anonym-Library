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
 * Class McryptCipher
 * @package Anonym\Crypt
 */
class McryptCipher extends Cipher
{

    /**
     * the randomizer algorithm for mcrypter
     *
     * @var mixed
     */
    protected $rand;


    /**
     * the iv value for mcrypter
     *
     * @var mixed
     */
    protected $iv;

    /**
     * the algorithm for mcrypter
     *
     * @var mixed
     */
    protected $algorithm;

    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function encode($value)
    {

    }

    /**
     * decrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function decode($value)
    {

    }
}
