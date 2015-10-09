<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Crypt;


/**
 * Class Crypter
 * @package Anonym\Crypt
 */
class Crypter extends  Cipher
{

    /**
     * the instance of cipher
     *
     * @var Cipher
     */
    protected $cipher;


    /**
     * create a instance and register cipher
     *
     * @param Cipher $cipher
     */
    public function __construct(Cipher $cipher)
    {
        $this->cipher = $cipher;
    }


    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function encode($value)
    {
        return $this->cipher->encode($value);
    }

    /**
     * decrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function decode($value)
    {
        return $this->cipher->decode($value);
    }
}
