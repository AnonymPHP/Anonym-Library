<?php
namespace Anonym\Database\Mode;

/**
 * @package  Anonym\Database\Base;
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

use Anonym\Database\Managers\BuildManager;
use Anonym\Database\Pagination\Paginator;
use Anonym\Database\Tongue\MysqlTongue;
use Anonym\Database\Tongue\MssqlTongue;
use Anonym\Database\Tongue\PgsqlTongue;
use Anonym\Database\Traits\Builder;
use Anonym\Database\Base;

/**
 * Class ModeManager
 * @package Anonym\Database\Mode
 */
class ModeManager
{

    use Builder;

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
     * Değiştirilecek desenleri tutar
     *
     * @var array
     */
    private $patterns = [

        'read' => [

            'SELECT :select FROM :from :join :group WHERE:where :order :limit',
            'SELECT :select FROM :from :join :group :order :limit'
        ],
        'update' => [

            'UPDATE :from SET :update WHERE:where'
        ],
        'delete' => [

            'DELETE FROM :from WHERE:where'
        ],
        'insert' => [
            'INSERT INTO :from SET :insert'
        ]
    ];

    /**
     * the constructor of ModeManager .
     *
     * @param Base $base
     */
    public function __construct(Base $base = null)
    {
        $this->setBase($base);
    }

    /**
     * create a new BuildManager instance with created query
     *
     * @return \Anonym\Database\Builders\BuildManager
     */
    public function build()
    {
        $query = $this->getQuery();
        $manager = new BuildManager($this->getBase()->getConnection());
        $manager->setPage($this->page);
        $manager->setQuery($query);
        $manager->setParams($this->string['parameters']);

        return $manager;
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

        switch ($type) {

            case 'and':

                $where = $this->useBuilder('where')
                    ->where($where, $this->getCield());

                break;

            case 'or':

                $where = $this->useBuilder('where')
                    ->orWhere($where, $this->getCield());

                break;
        }

        $this->string['where'] = $where['content'];
        $this->string['parameters'] = array_merge($this->string['parameters'], $where['array']);
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

        $this->doWhere($where, 'and');

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
     * OrWhere sorgusu
     *
     * @param mixed $where
     */
    public function orWhere($where)
    {

        $this->doWhere($where, 'or');
    }


    /**
     * @return \Anonym\Database\Base
     */
    public function getBase()
    {

        return $this->base;
    }


    /**
     * creating and getting the query
     *
     * @return \Anonym\Database\Builders\BuildManager
     */
    public function getQuery()
    {

        $strings = $this->string;
        $query = $this->buildQuery($this->getPattern($this->getChieldPattern()), $strings, $this->getBase()->getType());

        return $query;
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

}
