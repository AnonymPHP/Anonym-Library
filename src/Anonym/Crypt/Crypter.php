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
class Crypter implements CryptInterface
{

    /**
     * the instance of cipher
     *
     * @var Cipher
     */
    protected $cipher;

    /**
     * the private application key
     *
     * @var string
     */
    protected $appKey;

    /**
     * create a instance and register cipher
     *
     * @param string $appKey
     * @param Cipher $cipher
     */
    public function __construct($appKey, Cipher $cipher)
    {
        $this->appKey = $appKey;
        $this->cipher = $cipher;
    }
}
