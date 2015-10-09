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
    protected $mode = 'AES_256_CBC';

    /**
     * create a new instance and register the application key
     *
     * @param string $key
     */
    public function __construct($key){
        $this->appKey = $key;
    }

    /**
     * create the random application key
     *
     * @return string
     */
    protected function createEncryptionKey(){
        return substr(md5(openssl_random_pseudo_bytes(32).$this->appKey), 0, 32);
    }


    /**
     * create and return random iv string
     *
     * @return string
     */
    protected function createRandomIv(){
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->mode));
    }

    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function encode($value)
    {

        if(false !== $encrypted = openssl_encrypt(serialize($value), $this->mode, $key = $this->createEncryptionKey(), 0, $iv = $this->createRandomIv())){

        }

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
