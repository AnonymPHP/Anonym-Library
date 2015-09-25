<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */
namespace Anonym\Components\Database\Pagination;
use Closure;

class PaginationFactory
{

    /**
     * the closure for find current page
     *
     * @var Closure
     */
    protected static $currentPageFinder;

    /**
     * the closure for find current request url
     *
     * @var Closure
     */
    protected static $requestPathFinder;
    /**
     * the count of pages
     *
     * @var int
     */
    protected $count;

    /**
     * the expression of url
     *
     * @var string
     */
    protected $expression;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * the required parameter
     *
     * @var int|null
     */
    protected $currentPage;

    /**
     * the optional configs
     *
     * @var array
     */
    protected $options;

    /**
     * pagination datas
     *
     * @var mixed
     */
    protected $items;

    /**
     * @var array
     */
    protected $appends = [];

    /**
     * @var array
     */
    protected $fragments = [];

    /**
     * @return Closure
     */
    public static function getRequestPathFinder()
    {
        return self::$requestPathFinder;
    }

    /**
     * @param Closure $requestPathFinder
     */
    public static function setRequestPathFinder($requestPathFinder)
    {
        self::$requestPathFinder = $requestPathFinder;
    }

    /**
     * @return Closure
     */
    public static function getCurrentPageFinder()
    {
        return static::$currentPageFinder;
    }

    /**
     * @param Closure $currentPageFinder
     */
    public static function setCurrentPageFinder(Closure $currentPageFinder)
    {
        static::$currentPageFinder = $currentPageFinder;
    }




    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return PaginationFactory
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int|null $currentPage
     * @return PaginationFactory
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return PaginationFactory
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     * @return PaginationFactory
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * register maximum Total
     *
     * @param int $count
     * @return PaginationFactory
     */
    public function count($count = 1)
    {
        return $this->setCount($count);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return PaginationFactory
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     * @return PaginationFactory
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    /**
     * @param array $appends
     * @return PaginationFactory
     */
    public function setAppends($appends)
    {
        $this->appends = $appends;
        return $this;
    }

    /**
     * @return array
     */
    public function getFragments()
    {
        return $this->fragments;
    }

    /**
     * @param array $fragments
     * @return PaginationFactory
     */
    public function setFragments($fragments)
    {
        $this->fragments = $fragments;
        return $this;
    }



}

