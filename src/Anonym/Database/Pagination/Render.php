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


class Render
{

    /**
     * the path of urls
     *
     * @var string
     */
    private $path;

    /**
     * the name of page
     *
     * @var string
     */
    private $pageName;

    /**
     * the instance of pagination class
     *
     * @var Paginator
     */
    private $paginator;

    /**
     * create a new instance
     *
     * @param array $configs
     */
    public function __construct(Paginator $paginator = null)
    {
        $this->paginator = $paginator;

        $configs = $paginator->getOptions();
        $this->path = isset($configs['path']) ? $configs['path'] : '';
        $this->pageName = isset($configs['pageName']) ? $configs['pageName'] : 'page';
    }


    /**
     * create fragment string
     *
     * @param array $fragments
     * @return string
     */
    private function createFragmentsString(array $fragments)
    {
        return count($fragments) ? '#' . rtrim(join('#', $fragments), "#") : '';
    }

    /**
     * create append string
     *
     * @param array $appends
     * @return string
     */
    private function createAppendString(array $appends = [])
    {

        if (count($appends)) {
            return '?' . http_build_query($appends);
        } else {
            return '';
        }

    }

    /**
     * standart render
     *
     * @return string
     */
    public function standartRende()
    {
        $array = $this->standartRendeArray();
        return  count($array) ? join("\n", $array) : '';
    }

    /**
     *
     * rende pagination string to array
     *
     * @return array
     */
    public function standartRendeArray()
    {
        $array = [];
        $count = $this->paginator->getCount();
        $url = $this->path;
        $current = $this->paginator->getCurrentPage();

        // create appends string
        $appends = $this->createAppendString($this->paginator->getAppends());

        // create fragments string
        $fragments = $this->createFragmentsString($this->paginator->getFragments());

        if ($count < $this->paginator->getPerPage()) {
            $limit = 1;
        } else {
            $limit = ceil($count / $this->paginator->getPerPage());
        }

        if (false !== $before = $this->createBeforeButton($current, $this->buildFullChieldStrind($url, $appends), $this->pageName, $fragments)) {
            $array[] = $before;
        }

        for ($i = 1; $i <= $limit; $i++) {
            $array[] = $this->buildChieldString($i, $this->buildFullChieldStrind($url, $appends), $this->pageName, $fragments, $i);
        }

        if (false !== $after = $this->createAfterButton($current, $limit, $this->buildFullChieldStrind($url, $appends), $this->pageName, $fragments)) {
            $array[] = $after;
        }
        return $array;
    }


    /**
     * create pagination with only previous and next buttons
     *
     * @return array
     */
    public function simpleRendeArray()
    {
        $array = [];
        $count = $this->paginator->getCount();
        $url = $this->path;
        $current = $this->paginator->getCurrentPage();

        // create appends string
        $appends = $this->createAppendString($this->paginator->getAppends());

        // create fragments string
        $fragments = $this->createFragmentsString($this->paginator->getFragments());


        if ($count < $this->paginator->getPerPage()) {
            $limit = 1;
        } else {
            $limit = ceil($count / $this->paginator->getPerPage());
        }


        if ($this->isAvaibleCurrentPage($current) && $current > 1) {

            $previous = $current - 1;
            $array[] = $this->buildChieldString('Previous', $this->buildFullChieldStrind($url, $appends), $this->pageName, $fragments, $previous);

        }

        if ($this->isAvaibleCurrentPage($current) && $current < $limit) {
            $next = $current + 1;

            $array[] = $this->buildChieldString('Next', $this->buildFullChieldStrind($url, $appends), $this->pageName, $fragments, $next);
        }

        return $array;
    }


    /**
     * create pagination with only previous and next buttons
     *
     * @return string
     */
    public function simpleRende(){
        $array = $this->simpleRendeArray();

        return count($array) ? join("\n", $array) : '';
    }

    /**
     * build before button string
     *
     * @param int $current
     * @param string $url
     * @param string $class
     * @return bool|string
     */
    private function createBeforeButton($current, $url, $class, $fragments)
    {


        if ($this->isAvaibleCurrentPage($current) && $current > 1) {

            $page = $current - 1;

            return $this->buildChieldString("&laquo;", $url, $class, $fragments, $page);
        } else {
            return false;
        }
    }

    /**&raquo;
     * build next button string
     *
     * @param int $current
     * @param int $limit
     * @param string $url
     * @param string $class
     * @return bool|string
     */
    private function createAfterButton($current, $limit, $url, $class, $fragments)
    {
        if ($this->isAvaibleCurrentPage($current) && $current < $limit) {

            $page = $current - 1;

            return $this->buildChieldString("&laquo;", $url, $class, $fragments, $page);
        } else {
            return false;
        }
    }

    /**
     * create chield string
     *
     * @param string $page
     * @param string $url
     * @return string
     */
    private function buildChieldString($page, $url, $pageName, $fragments, $i)
    {
        settype($page, 'string');

        $add = $this->buildAddUrl($url);
        $string = $url . $add . $i . $fragments;
        return sprintf("<li><a href='%s' class='%s'>%s</a></li>", $string, $pageName, $page);
    }

    /**
     * @param $url
     * @return string
     */
    private function buildAddUrl($url)
    {
        return strstr($url, '?') ? '&page=' : '?page=';
    }

    /**
     * check validity of current page
     *
     * @param mixed $current
     * @return bool
     */
    private function isAvaibleCurrentPage($current)
    {
        settype($current, 'integer');
        return is_integer($current) && $current > 0 ? true : false;
    }

    /**
     * create full chield string
     *
     * @param string $chield
     * @param string $appends
     * @return string
     */
    private function buildFullChieldStrind($chield, $appends)
    {
        return $chield . $appends;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Render
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     * @return Render
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
        return $this;
    }

    /**
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param Paginator $paginator
     * @return Render
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
        return $this;
    }


}