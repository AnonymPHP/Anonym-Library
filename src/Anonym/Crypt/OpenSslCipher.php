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
     * the encrypting method for open ssl driver
     *
     * @var string
     */
    protected $mode = 'AES-256-CBC';

    /**
     * the secret key created for encrypting
     *
     * @var string
     */
    protected $key;


    /**
     * create a new instance and register security key
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }


    protected function createSecurityKeyAndIv()
    {
        $key = $this->key;

        $securityKey = hash('sha256', $key);

        $iv = substr($securityKey, 0, 16);

        return [
            $iv,
            hash('sha256', $securityKey.':iv'.$iv)
        ];
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
