<?php

/**
 *  AnonymFramework Database Read Mode -> veritabanından veri okumakda kullanılır
 *
 * @package Anonym\Database\Mode
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */

namespace Anonym\Database\Mode;

use Anonym\Database\Base;
use Anonym\Database\Traits\Builder;
use Anonym\Facades\Config;

/**
 * Class Read
 * @package Anonym\Database\Mode
 */
class Read extends ModeManager
{

    use Builder;

    /**
     * As değerini tutar
     *
     * @var mixed
     */
    private $as;

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

        $this->string['order'] .= [$order, $type];
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
        $this->string['join'] = $join;
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

        $this->string['group'] = $group;

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

        $this->string['limit'] .= $limit;

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
}
