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

use Anonym\Crypt\Exception\CipherNotInstalledException;

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
    protected $rand = MCRYPT_RAND;


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
    protected $algorithm = MCRYPT_RIJNDAEL_128;


    /**
     * the mode of mcrypter
     *
     * @var string
     */
    protected $mode = MCRYPT_MODE_CBC;

    /**
     * the private application keys
     *
     * @var string
     */
    protected $key;

    /**
     * create an instance and check Mcrypt driver is installed?
     *
     * @param string $key the special application key
     * @throws CipherNotInstalledException if mcrypt driver is not installed before, this exception will throw
     */
    public function __construct($key)
    {
        $this->key = $key;

        if (!function_exists('mcrypt_create_iv')) {
            throw new CipherNotInstalledException(sprintf('Mcrypt cipher is not installed on your server'));
        }
    }


    /**
     * create your special iv value
     *
     * @return string
     */
    private function createIvSizeAndIvString()
    {
        $ivSize = mcrypt_get_iv_size($this->algorithm, $this->mode);

        return mcrypt_create_iv($ivSize, $this->rand);
    }

    /**
     *  create your special key
     */
    private function createSpecialKey($iv)
    {
        $combinedString = $this->key.$iv;

        return substr(base64_encode($combinedString), 0, 16);
    }

    /**
     * encrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function encode($value)
    {

        $createdIv = $this->createIvSizeAndIvString();
        $createdKey = $this->createSpecialKey($createdIv);

        if (false !== $encrypted = @mcrypt_encrypt($this->algorithm, $createdKey, $value, $this->mode, $createdIv)) {

            return base64_encode(
                serialize(
                    [
                        'iv'    => base64_encode($createdIv),
                        'key'   => base64_encode($createdKey),
                        'value' => trim(base64_encode($encrypted)),
                    ]
                )
            );
        }

        return false;
    }

    /**
     * decrypt the value
     *
     * @param string $value
     * @return mixed
     */
    public function decode($value)
    {


        $prepareForDecrypt = @unserialize(base64_decode($value));
        $preparedIv = base64_decode($prepareForDecrypt['iv']);
        $preparedKey = base64_decode($prepareForDecrypt['key']);

        $value = base64_decode($prepareForDecrypt['value']);

        if (false !== $decypted = @mcrypt_decrypt($this->algorithm, $preparedKey, $value, $this->mode, $preparedIv)) {
            return trim($decypted, "\0\4");
        }

        return false;
    }
}
