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
        return $this->doProccess($value);
    }

    /**
     * encrypt or decrypt value and return it
     *
     * @param $value
     * @param string $action
     * @return bool|string
     */
    private function doProccess($value, $action = 'encrypt')
    {

        $output = false;

        $encryptMethod = $this->getMethod();
        $secretKey = $this->getApplicationKey();
        $secretIv = $this->getIv();

        // hash
        $key = hash('sha256', $secretKey);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secretIv), 0, 16);


        if ($action === 'encrypt') {
            $output = openssl_encrypt(urlencode($value), $encryptMethod, $key, false, $iv);
            $output = base64_encode($output);
        } else {
            if ($action === 'decrypt') {

                $value = urldecode(base64_decode($value));
                $output = openssl_decrypt($value, $encryptMethod, $key, false, $iv);
            }
        }

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
        return $this->doProccess($value, 'decrypt');
    }


    /**
     * decrypt the value
     *
     * @param string $value
     * @return string
     */
    public function decrypt($value)
    {
        return $this->decode($value);
    }

    /**
     * encrypt the value
     *
     * @param string $value
     * @return string
     */
    public function encrypt($value)
    {
        return $this->encode($value);
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
