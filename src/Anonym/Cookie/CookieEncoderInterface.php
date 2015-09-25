<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Cookie;

/**
 * Interface CookieEncoderInterface
 * @package Anonym\Cookie
 */
interface CookieEncoderInterface
{

    /**
     * Metni şifreler
     *
     * @param string $value
     * @return string
     */
    public function encode($value = '');

    /**
     * Metnin şifresini çözer
     *
     * @param string $value
     * @return string
     */
    public function decode($value = '');
}
