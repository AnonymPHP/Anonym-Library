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
class Crypter
{

    /**
     * the instance of crypting driver
     *
     * @var CryptInterface
     */
    private $crypter;


    /**
     * Veriyi şifreler
     *
     * @param string $encode
     * @return string
     */
    public function encode($encode = '')
    {
        $crypter = $this->getCrypter();

        if ($crypter instanceof CryptInterface) {
            return $crypter->encode($encode);
        } else {
            return false;
        }
    }

    /**
     * Şifrelenmiş veriyi çözer
     *
     * @param string $decode
     * @return string
     */
    public function decode($decode = '')
    {
        $crypter = $this->getCrypter();

        if ($crypter instanceof CryptInterface) {
            return $crypter->decode($decode);
        } else {
            return false;
        }
    }

    /**
     * @return CryptInterface
     */
    public function getCrypter()
    {
        return $this->crypter;
    }

    /**
     * @param CryptInterface $crypter
     * @return Crypter
     */
    public function setCrypter($crypter)
    {
        $this->crypter = $crypter;

        return $this;
    }
}
