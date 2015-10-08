<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Crypt;

use Exception;

/**
 * Class AnonymCrypt
 * @package Anonym\Crypt
 */
class AnonymCrypt implements CryptInterface
{

    /**
     * the random key for security key
     *
     * @var string
     */
    protected $applicationKey;

    /**
     * the crypting method
     *
     * @var string
     */
    protected $method = "AES-256-CBC";

    /**
     * the crypting secret iv key
     *
     * @var string
     */
    protected $iv = "";

    /**
     * Sınıfı başlatır
     *
     * @throws Exception
     */
    public function __construct($applicationKey)
    {
        if (!function_exists('openssl_encrypt')) {
            throw new Exception('OpenSsl extension is must be installed on your server.');
        }


        $this->iv = (new SecurityKeyGenerator())->create($applicationKey);
        $this->applicationKey = $applicationKey;
    }


    /**
     * encrypt the data
     *
     * @param string $value
     * @return string
     */
    public function encode($value = '')
    {
        $output = false;

        $encryptMethod = $this->getMethod();
        $secretKey = $this->getApplicationKey();
        $secretIv = $this->getIv();

        // hash
        $key = hash('sha256', $secretKey);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secretIv), 0, 16);

        $output = openssl_encrypt($value, $encryptMethod, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;
    }

    /**
     * Şifrelenmiş metni çözer
     *
     * @param string $value
     * @return string
     */
    public function decode($value = '')
    {
        // TODO: Implement decode() method.
    }

    /**
     * @return string
     */
    public function getApplicationKey()
    {
        return $this->applicationKey;
    }

    /**
     * regiter the application key
     *
     * @param string $applicationKey
     * @return AnonymCrypt
     */
    public function setApplicationKey($applicationKey)
    {
        $this->applicationKey = $applicationKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * @return string
     */
    public function getIv()
    {
        return $this->iv;
    }

}
