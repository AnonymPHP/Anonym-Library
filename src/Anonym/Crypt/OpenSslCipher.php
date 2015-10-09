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


class OpenSslCipher extends Cipher
{

    /**
     * the application key for security key
     *
     * @var string
     */
    protected $appKey;

    /**
     * the encrypting method for open ssl cipher
     *
     * @var string
     */
    protected $mode;

    /**
     * create a new instance and register the application key
     *
     * @param string $key
     */
    public function __construct($key){
        $this->appKey = $key;
    }

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
