<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Route;

use Anonym\Components\Route\Matchers\MatcherInterface;
use Anonym\Components\Route\Matchers\NewMatcher;

/**
 * Class RouteMatcher
 * @package Anonym\Components\Route
 */
class RouteMatcher implements RouteMatcherInterface, MatcherInterface
{

    /**
     * Parametre adlarını depolar
     *
     * @var array
     */
    protected $parameters = [];
    /**
     * Filtreleri toplar
     *
     * @var array
     */
    protected $filters;

    /**
     * Çağrılan url i getirir
     *
     * @var string
     */
    protected $requestedUrl;

    /**
     * Eşleştirilecek url i tutar
     *
     * @var string
     */
    private $matchUrl;


    /**
     * Eşleştirilecek ve eşleşmesi gerek url i ayarlar
     *
     * @param string $requestedUrl
     * @param string $matchUrl
     * @param array $filters
     */
    public function __construct($requestedUrl = '', $matchUrl = '', $filters = [])
    {
        $this->setMatchUrl($matchUrl);
        $this->setRequestedUrl($requestedUrl);
        $this->setFilters($filters);
    }

    /**
     * match uri for when( method
     *
     * @param null|string $url
     * @return bool
     */
    public function matchWhen($url = null)
    {
        if (null !== $url) {
            $this->setMatchUrl($url);
        }

        return strpos($this->getRequestedUrl(), $this->getMatchUrl()) === 0;
    }

    /**
     * Eşleşmeyi yapar
     *
     * @param string $matchUrl
     * @return bool
     */
    public function match($matchUrl = null)
    {
        if (null !== $matchUrl) {
            $this->setMatchUrl($matchUrl);
        }

        if ($this->isUrlEqual()) {
            return true;
        } else {
            return false;
        }

    }


    /**
     *
     * Urller aynı ise direk döndürüyor
     *
     * @param string $url
     * @return bool
     */
    public function isUrlEqual($url = null)
    {

        if($url === null){
            $url = $this->getMatchUrl();
        }

        $url = str_replace('/', ' ', $url);
        $requested = str_replace('/', ' ', $this->getRequestedUrl());

        return trim($url) === trim($requested);

    }

    /**
     * @return string
     */
    public function getRequestedUrl()
    {
        return $this->requestedUrl;
    }


    /**
     * @param string $requestedUrl
     * @return RouteMatcher
     */
    public function setRequestedUrl($requestedUrl)
    {
        $requestedUrl = trim(str_replace('/', ' ', $requestedUrl));
        $this->requestedUrl = $requestedUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatchUrl()
    {
        return $this->matchUrl;
    }

    /**
     * Eşleştirilecek url i ayarlar
     *
     * @param string $matchUrl
     * @return RouteMatcher
     */
    public function setMatchUrl($matchUrl)
    {
        $matchUrl = trim(str_replace('/', ' ', $matchUrl));
        $this->matchUrl = $matchUrl;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return RouteMatcher
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * $name ile girilen filter 'ı arar
     *
     * @param string $name
     * @return mixed
     */
    public function getFilter($name = '')
    {
        return isset($this->filters[$name]) ? $this->filters[$name] : false;
    }


    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return RouteMatcher
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
}

