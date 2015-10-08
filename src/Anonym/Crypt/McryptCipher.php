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

use Anonym\Components\Crypt\Exception\CipherNotInstalledException;

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
     * @param string $key                  the special application key
     * @throws CipherNotInstalledException if mcrypt driver is not installed before, this exception will throw
     */
    public function __construct($key){
        $this->key = $key;

        if(!function_exists('mcrypt_encode')){
            throw new CipherNotInstalledException(sprintf('Mcrypt cipher is not installed on your server'));
        }
    }


    /**
     * create your special iv value
     *
     * @return string
     */
    private function createIvSizeAndIvString(){
        $ivSize = mcrypt_get_iv_size($this->algorithm, $this->mode);

        return mcrypt_create_iv($ivSize, $this->rand);
    }

    /**
     *  create your special key
     */
    private function createSpecialKey($iv){
        $combinedString = $this->key. $iv;

        return password_hash($combinedString, PASSWORD_BCRYPT);
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
