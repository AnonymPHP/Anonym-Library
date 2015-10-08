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
    protected $rand;


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
    protected $algorithm;

    /**
     * the private application keys
     *
     * @var string
     */
    protected $key;

    /**
     * create an instance and check Mcrypt driver is installed?
     *
     * @param string $key
     * @throws CipherNotInstalledException
     */
    public function __construct($key){
        $this->key = $key;

        if(!function_exists('mcrypt_encode')){
            throw new CipherNotInstalledException(sprintf('Mcrypt cipher is not installed on your server'));
        }
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
