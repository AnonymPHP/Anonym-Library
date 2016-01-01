<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\OAuth;

use Anonym\Facades\Session;

/**
 * Class Github
 * @package Anonym\OAuth
 */
class Github
{

    /**
     * @var string
     */
    protected $clientID = '';

    /**
     * @var string
     */
    protected $clientSecret = '';

    /**
     * @var string
     */
    protected $authorizeURL = 'https://github.com/login/oauth/authorize';

    /**
     * @var string
     */
    protected $tokenURL = 'https://github.com/login/oauth/access_token';

    /**
     * @var string
     */
    protected $apiURLBase = 'https://api.github.com/';


    /**
     * the constructor of Github .
     * @param string $clientID
     * @param string $clientSecret
     */
    public function __construct($clientID = '', $clientSecret = '')
    {
        $this->setClientID($clientID)->setClientSecret($clientSecret);
    }

    /**
     * @param string $url
     * @param bool $post
     * @param array $headers
     * @return mixed
     */
    public function getApiRequest($url = '', $post = false, $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $headers[] = 'Accept: application/json';
        if (Session::has('access_token'))
            $headers[] = 'Authorization: Bearer ' . Session::get('access_token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        return $response;
    }


    /**
     * @return string
     */
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     * @param string $clientID
     * @return $this
     */
    public function setClientID($clientID)
    {
        $this->clientID = $clientID;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizeURL()
    {
        return $this->authorizeURL;
    }

    /**
     * @param string $authorizeURL
     * @return $this
     */
    public function setAuthorizeURL($authorizeURL)
    {
        $this->authorizeURL = $authorizeURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenURL()
    {
        return $this->tokenURL;
    }

    /**
     * @param string $tokenURL
     * @return $this
     */
    public function setTokenURL($tokenURL)
    {
        $this->tokenURL = $tokenURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiURLBase()
    {
        return $this->apiURLBase;
    }

    /**
     * @param string $apiURLBase
     * @return $this
     */
    public function setApiURLBase($apiURLBase)
    {
        $this->apiURLBase = $apiURLBase;
        return $this;
    }
    
}
