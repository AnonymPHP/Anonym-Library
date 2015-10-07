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

/**
 * Interface CryptInterface
 * @package Anonym\Crypt
 */
interface CryptInterface
{

    /**
     * encrypt the data
     *
     * @param string $value
     * @return string
     */
    public function encode($value = '');



    /**
     * Şifrelenmiş metni çözer
     *
     * @param string $value
     * @return string
     */
    public function decode($value = '');

}
