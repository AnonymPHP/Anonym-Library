<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

/**
 * Class QueryBuilder
 * @package Anonym\Database
 */
class QueryBuilder
{

    /**
     * As değerini tutar
     *
     * @var mixed
     */
    private $as;

    /**
     * a type of array for create query
     *
     * @var array
     */
    private $tongueBuilders = [
        Base::TYPE_MYSQL => MysqlTongue::class,
        Base::TYPE_MSSQL => MssqlTongue::class,
        Base::TYPE_PGSQL => PgsqlTongue::class
    ];

    /**
     * @var Base
     */
    private $base;

    /**
     * Sayfa numarasını tutar
     *
     * @var int
     */
    protected $page;

    /**
     * the constructor of ModeManager .
     *
     * @param Base $base
     */
    public function __construct(Base $base = null)
    {
        $this->setBase($base);
        $this->datas['from'] = $base->getConnectedTable();
        $this->datas['select'] = '*';
    }

    /**
     * create a new BuildManager instance with created query
     *
     * @return \Anonym\Database\Managers\BuildManager
     */
    public function build()
    {
        list($query, $parameters) =  array_values($this->buildQuery());
        $manager = new BuildManager($this->getBase()->getConnection());
        $manager->setQuery($query);
        $manager->setParams($parameters);

        return $manager;
    }

    /**
     * building your query string
     *
     * @return string
     */
    protected function buildQuery(){
        return $this->getBase()->bridge->tongue->build($this->datas);
    }


    /**
     * Query oluşturur
     *
     * @return \PDOStatement
     */
    public function run()
    {
        return $this->build()->run();
    }

    /**
     * store the content
     *
     * @var string
     */
    protected $datas;

    /**
     * @param $base
     * @return $this
     */
    public function setBase($base)
    {

        $this->base = $base;

        return $this;
    }


    /**
     * Where tetiklenir
     *
     * @param mixed $args
     * @param string $type
     */
    private function doWhere($where, $type)
    {
        $where[0][] = $type;
        $this->datas['where'][] = $where;
    }

    /**
     * Where  sorgusu
     *
     * @param mixed $where
     * @param null controll
     * @return $this
     */
    public function where($where, $controll = null)
    {

        if (!is_array($where) && !is_null($controll)) {

            $where = [
                [$where, '=', $controll]
            ];
        } elseif (is_array($where) && isset($where[0]) && isset($where[1])) {

            if (is_string($where[1])) {

                $where = [
                    [$where[0], $where[1], $where[2]]
                ];
            }
        }

        $this->doWhere($where, 'AND');

        return $this;
    }

    /**
     * add a new like statement
     *
     * @param string $column
     * @param string $statement
     * @return $this
     */
    public function like($column, $statement){
        $this->datas['like'][] = [$column, $statement, 'AND'];

        return $this;
    }

    /**
     * add a new orLike statement
     *
     * @param string $column
     * @param string $statement
     * @return $this
     */
    public function orLike($column, $statement){
        $this->datas['like'][] = [$column, $statement, 'OR'];

        return $this;
    }


    /**
     * create a instance for standart pagination
     *
     * @param int $perPage
     * @return Paginator
     */
    public function pagination($perPage = 15)
    {

        $currentPageFinder = Paginator::getCurrentPageFinder();
        $pathFinder = Paginator::getRequestPathFinder();


        $pagination = new Paginator($perPage, call_user_func($currentPageFinder), [
            'pageName' => 'page',
            'path' => call_user_func($pathFinder),
        ]);

        $pagination->setMode(Paginator::MODE_STANDART);
        $count = $this->build()->rowCount();

        $pagination->count($count);

        return $pagination;
    }


    /**
     * create a paginaton instance and return it
     *
     * @param int $perPage
     * @return Paginator
     */
    public function simplePagination($perPage = 15)
    {
        $pegination = $this->pagination($perPage);

        $pegination->setMode(Paginator::MODE_SIMPLE);
        return $pegination;
    }

    /**
     * Where  sorgusu
     *
     * @param mixed $where
     * @param null controll
     * @return $this
     */
    public function orWhere($where, $controll = null)
    {

        if (!is_array($where) && !is_null($controll)) {

            $where = [
                [$where, '=', $controll]
            ];
        } elseif (is_array($where) && isset($where[0]) && isset($where[1])) {

            if (is_string($where[1])) {

                $where = [
                    [$where[0], $where[1], $where[2]]
                ];
            }
        }

        $this->doWhere($where, 'OR');

        return $this;
    }


    /**
     * @return \Anonym\Database\Base
     */
    public function getBase()
    {

        return $this->base;
    }

    /**
     * @param string $pattern
     * @return multitype:multitype:string
     */
    protected function getPattern($pattern)
    {

        if (isset($this->patterns[$pattern])) {

            return $this->patterns[$pattern];
        }
    }

    /**
     * Pattern atamas� yapar
     *
     * @param string $name
     * @param array $patterns
     */
    protected function setPattern($name, array $patterns)
    {

        $this->patterns[$name] = $patterns;
    }

    /**
     * Select sorgusu olu�turur
     *
     * @param string $select
     * @return $this
     */
    public function select($select = null)
    {

        $this->datas['select'] = $select;

        return $this;
    }


    /**
     * İçeriği temizler
     *
     * @return static
     */
    private function cleanThis()
    {

        return new static($this->getBase());
    }

    /**
     * Order Sorgusu oluşturur
     *
     * @param string $order
     * @param string $type
     * @return \Anonym\Database\Mode\Read
     */
    public function order($order, $type = 'DESC')
    {

        $this->datas['order'] = [$order, $type];
        return $this;
    }


    /**
     * Join komutu ekler
     *
     * @param array $join
     * @return $this
     */
    public function join($join = [])
    {
        $this->datas['join'] = $join;
        return $this;
    }

    /**
     * @param int $page
     * @return \Anonym\Database\Mode\Read
     */
    public function page($page)
    {
        $this->page = $page;
        $limit = Config::get('database.pagination');
        $limit = $limit['limit'];
        $baslangic = ($page - 1) * ($limit);
        $bitis = $page * $limit;

        return $this->limit([$baslangic, $bitis]);
    }

    /**
     * Group By sorgusu ekler
     *
     * @param string $group
     * @return \Anonym\Database\Mode\Read
     */
    public function group($group)
    {

        $this->datas['group'] = $group;

        return $this;
    }


    /**
     * İç içe bir sorgu oluşturur
     *
     * @param string $as
     * @param mixed $select
     * @return  \Anonym\Database\Mode\Read
     */
    public function create($as, $select)
    {

        $this->setAs($as);

        return $this->select($select);
    }

    /**
     * Limit sorgusu oluşturur
     *
     * @param string $limit
     * @return \Anonym\Database\Mode\Read
     */
    public function limit($limit)
    {

        $this->datas['limit'] = $limit;

        return $this;
    }


    /**
     * @param string $as
     * @return \Anonym\Database\Mode\Read
     */
    public function setAs($as)
    {
        $this->as = $as;
        return $this;
    }


    /**
     * Select de kullanılacak as değerini döndürür
     *
     * @return string
     */
    public function getAs()
    {

        return $this->as;
    }

    /**
     * Etkilenen elaman sayısını döndürür
     *
     * @return int
     */

    public function rowCount()
    {
        return $this->build()->rowCount();
    }


    /**
     * @param array $set
     * @return $this
     */
    public function set($set = [])
    {
        $this->datas['insert'][] = $set;
        return $this;
    }



    /**
     * İçeriği tekil veya çokul olarak döndürür
     *
     * @param bool $fetchAll
     * @return array|mixed|object|\stdClass
     * @throws \Exception
     */
    public function fetch($fetchAll = false)
    {

        return $this->build()->fetch($fetchAll);
    }

    /**
     * Tüm İçeriği Döndürür
     *
     * @return array|mixed|object|\stdClass
     */
    public function fetchAll()
    {

        return $this->fetch(true);
    }


    /**
     * @param array $set
     * @return $this
     */
    public function update($set = [])
    {
        $this->datas['update'][] = $set;
        return $this;
    }
}