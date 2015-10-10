<?php

/**
 *  Bu Sınıf AnonymFramework'de cookie işlemlerinin yapılması için yapılmıştır
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */
namespace Anonym\Cookie\Http;

use Anonym\Cookie\ReposityInterface;
use Anonym\Http\RequestHeaders;

/**
 * Class CookieBag
 * @package Anonym\Cookie\Http
 */
class CookieBag extends RequestHeaders implements ReposityInterface
{

    /**
     * Cookileri tutar
     *
     * @var array
     */
    private $cookies;

    /**
     * Cookie değerlerini atar
     */
    public function __construct()
    {
        parent::__construct();

        $get = $this->headers;
        if (isset($get['Cookie'])) {
            $this->cookies = $this->rendeCookieString($get['Cookie']);
        } else {
            $this->cookies = [];
        }
    }

    /**
     * Cookie verilerini parçalar
     *
     * @param string $cookie
     * @return array
     */
    private function rendeCookieString($cookie = '')
    {

        if ($cookie !== '') {

            $explode = explode(";", $cookie);
            $cookies = [];

            foreach ($explode as $ex) {

                $ex = explode('=', $ex, 2);
                $cookies[trim($ex[0])] = urldecode($ex[1]);
            }

            return $cookies;
        }
    }

    /**
     * Cookileri döndürür
     *
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }
}

