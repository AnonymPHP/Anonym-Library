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

/**
 * Class Paginator
 * @package Anonym\Components\Database\Pagination
 */
class Paginator extends PaginationFactory
{

    const MODE_STANDART = 1;
    const MODE_SIMPLE = 2;

    /**
     * the mode of pagination
     *
     * @var int
     */
    protected $mode = 2;


    /**
     * create a new instance and register options and more variables
     *
     * @param mixed $items
     * @param int $perPage
     * @param null $currentPage
     * @param array $options
     */
    public function __construct($perPage, $currentPage = null, array $options = [])
    {
        $this->setCurrentPage($currentPage)
            ->setPerPage($perPage)
            ->setOptions($options);

    }


    /**
     * register the url pattern
     *
     * @param string $expression
     * @return $this
     */
    public function customUrl($expression = '')
    {
        $this->setExpression($expression);
        return $this;
    }

    /**
     * get all appends
     *
     * @param array $appends
     * @return $this
     */
    public function appends(array $appends = [])
    {
        $this->appends = array_merge($this->appends, $appends);
        return $this;
    }


    /**
     * add a new fragment to url
     *
     * @param string $name
     * @return $this
     */
    public function fragment($name = '')
    {
        $this->fragments[] = $name;
        return $this;
    }

    /**
     * get next page
     *
     * if current page is null, current page accept 0
     *
     * @return int
     */
    public function nextPage()
    {
        $current = $this->getCurrentPage();

        if (!is_int($current)) {
            $current = 0;
        }

        return $current + 1;
    }

    /**
     * return per page
     *
     * @return int
     */
    public function perPage()
    {
        return $this->getPerPage();
    }

    /**
     * return current page
     *
     * @return int|null
     */
    public function currentPage()
    {
        return $this->getCurrentPage();
    }

    /**
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     * @return Paginator
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }



    /**
     * rende the pagination to string
     *
     * @return string
     */
    public function render()
    {

        $render = new Render($this);
        if ($this->getMode() === static::MODE_SIMPLE) {
            return $render->simpleRende();
        }else{
            return $render->standartRende();
        }

    }

    /**
     * rende the pagination to an array
     *
     * @return array
     */
    public function rendeToArray(){
        $render = new Render($this);
        if ($this->getMode() === static::MODE_SIMPLE) {
            return $render->simpleRendeArray();
        }else{
            return $render->standartRendeArray();
        }
    }

    /**
     * create a string
     *
     * @return string
     */
    public function __toString(){
        return $this->render();
    }

}
