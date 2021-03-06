<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Cookie;

use Anonym\Cookie\Http\CookieBag as Reposity;
use Anonym\Cookie\Http\CookieJar as Generator;
use Anonym\Crypt\Cipher;
use Anonym\Crypt\CryptInterface;
use InvalidArgumentException;

/**
 * Class Cookie
 * @package Anonym\Cookie
 */
class Cookie implements CookieInterface
{
    /**
     * Cookie verilerini tutar
     *
     * @var array
     */
    private $reposity;

    /**
     * Şifreleyiciyi tutar
     *
     * @var CookieEncoderInterface
     */
    private $encoder;


    /**
     * Metinlerin şifrelenip şifrelenmeyeceğini tutar
     *
     * @var bool
     */
    private $encode;

    /**
     * Sınıfı başlatır
     *
     * @param bool $encode
     */
    public function __construct($encode = false)
    {
        $this->setReposity(new Reposity());
        $this->setEncode($encode);
    }


    /**
     * Cookie olayını tutar
     *
     * @param string $name
     * @return mixed
     */
    public function get($name = '')
    {
        $name = $this->encodeForName($name);

        if (!is_string($name)) {
            throw new InvalidArgumentException('Cookiler sadece string olarak depolanabilir');
        }

        $value = $this->reposity[$name];

        if ($this->isEncode()) {
            return $this->getEncoder()->decode($value);
        }

        return $value;
    }

    /**
     * Öyle bir cookie varmı yokmu diye bakar
     *
     * @param string $name
     * @return bool
     */
    public function has($name = '')
    {
        $name = $this->encodeForName($name);

        if (!is_string($name)) {
            throw new InvalidArgumentException('Cookiler sadece string olarak depolanabilir');
        }

        return isset($this->reposity[$name]);
    }

    /**
     * encrypt the name parameter for valid cookie name
     *
     * @param string $name
     * @return string
     */
    private function encodeForName($name)
    {
        return sha1(md5($name));
    }

    /**
     * Cookie Atamasını yapar
     * $name -> cookie adı
     * $value -> cookie değeri
     * $expires -> geçerlilik süresi
     * $path->cookie nin geçerli olacağı alan
     * $domain->cookie'in geçerli olduğu domain
     * $sucere->cookie'nin secure değeri
     * $httpOnly -> cookie'in httpony değeri
     *
     * @param string $name
     * @param string $value
     * @param int $expires
     * @param string $path
     * @param null $domain
     * @param bool $secure
     * @param bool $httpOnly
     * @return $this
     */
    public function set(
        $name = '',
        $value = '',
        $expires = 3600,
        $path = '/',
        $domain = null,
        $secure = false,
        $httpOnly = false
    ) {


        if (!is_string($name)) {
            throw new InvalidArgumentException('The Cookie must be a string');
        }

        $name = $this->encodeForName($name);

        if (!is_string($value)) {
            throw new InvalidArgumentException('The Cookie value must be a string');
        }


        if ($this->isEncode()) {
            $value = $this->getEncoder()->encode($value);
        }

        $cookie = Generator::make($name, $value, $expires, $path, $domain, $secure, $httpOnly);
        CookieContainer::addCookie($cookie);

        return $this;
    }

    /**
     * Girilen name değerini siler
     *
     * @param $name
     * @return $this
     */
    public function delete($name)
    {

        $name = $this->encodeForName($name);

        return $this->set($name, '');
    }

    /**
     * this cookie life very long time
     *
     * @param string $name
     * @param string $value
     * @param string $path
     * @param null $domain
     * @param bool $secure
     * @param bool $httpOnly
     * @return $this
     */
    public function forever(
        $name = '',
        $value = '',
        $path = '/',
        $domain = null,
        $secure = false,
        $httpOnly = false
    ) {
        $this->set($name, $value, 2628000, $path, $domain, $secure, $httpOnly);

        return $this;
    }

    /**
     * @return Cipher
     */
    public function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * @param Cipher $encoder
     * @return Cookie
     */
    public function setEncoder(Cipher $encoder)
    {
        $this->encoder = $encoder;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEncode()
    {
        return $this->encode;
    }

    /**
     * @param boolean $encode
     * @return Cookie
     */
    public function setEncode($encode)
    {
        $this->encode = $encode;

        return $this;
    }


    /**
     * @return array
     */
    public function getReposity()
    {
        return $this->reposity;
    }

    /**
     * @param Reposity $reposity
     * @return Cookie
     */
    public function setReposity($reposity)
    {
        if ($reposity instanceof ReposityInterface) {
            $this->reposity = $reposity->getCookies();
        }

        return $this;
    }
}
