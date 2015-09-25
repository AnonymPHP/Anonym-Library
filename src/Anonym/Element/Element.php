<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı işlemlerini yapmak için tasarlanmıştır
 */

namespace Anonym\Components\Element;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Mode\Delete;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Database\Mode\Update;
use Anonym\Components\Database\Mode\Insert;
use Anonym\Components\Database\Mode\ModeManager;
use Exception;
use PDO;

/**
 * Class Orm
 *
 * @package Anonym\Orm
 */
class Element
{


    /**
     * Where sorgularını depolar
     *
     * @var array
     */
    private $where;

    /**
     * OrWhere Sorgularını toplar
     *
     * @var array
     */
    private $orWhere;

    /**
     * Veritabanına eklenecek verileri deoplar
     *
     * @var array
     */
    private $set;

    /**
     * Veritabanından seçilecek tabloları depolar
     *
     * @var array
     */
    private $select;

    /**
     * Limit sorgusunu depolar
     *
     * @var array
     */
    private $limit;

    /**
     * Veritabanı grup sorgusunu depolar
     *
     * @var string
     */
    private $group;

    /**
     * Veritabanı sıralama sorgusu depolar
     *
     * @var string
     */
    private $order;

    /**
     * Sayfalama için şuanda bulunan sayfayı depolar
     *
     * @var int
     */
    private $page;

    /**
     * Sıralamanın hangi tipte olacağını depolar
     *
     * @var string
     */
    private $orderType;

    /**
     * Veritabanında hangi sayfanın seçildiğini deolar
     *
     * @var string
     */
    private $table;

    /**
     * Veritabanı nesnesini depolar
     *
     * @var Base
     */
    private $db;

    /**
     * Veritabanı join sorgularını depolar
     *
     * @var string
     */
    private $join;

    /**
     *
     * Sınıfı ve Ebeveyn sınıfı başlatır.
     * @param Base $base the instance of database
     */
    public function __construct(Base $base = null)
    {
        $this->db = $base;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function find($id = 1)
    {
        $this->where('id', $id);

        return $this;
    }

    /**
     * Sorguya join kodu ekler
     * @param array $join
     * @return $this
     */
    public function join(array $join = [])
    {
        $this->join = $join;
        return $this;
    }

    /**
     * Sorguya where komutu ekler
     *
     * @param      $id
     * @param null $controll
     * @return $this
     */
    public function where($id, $controll = null)
    {
        if (!is_array($id) && !is_array($controll)) {
            $this->where[] = [$id, '=', $controll];
        } elseif (is_array($id) && is_null($controll)) {
            $this->where = $id;
        }

        return $this;
    }

    /**
     * Sayfalama yapabilmek sayfa numarasını alır
     *
     * @param int $page
     * @return $this
     */
    public function page($page = 1)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Sorguya or where komutu ekler
     *
     * @param      $id
     * @param null $controll
     * @return $this
     */
    public function orWhere($id, $controll = null)
    {
        if (!is_array($id) && !is_array($controll)) {
            $this->orWhere[] = [$id, '=', $controll];
        } elseif (is_array($id) && is_null($controll)) {
            $this->orWhere = array_merge($this->where, $id);
        }

        return $this;
    }

    /**
     * Sorguya grup komutu ekler
     *
     * @param string $group
     * @return $this
     */
    public function group($group = '')
    {
        $this->group = $group;

        return $this;
    }

    /**
     *
     *
     * @param string $table
     * @return Element
     */
    public function table($table){
        return $this->setTable($table);
    }

    /**
     * Kullanılacak tabloyu atar
     *
     * @param string $table
     * @return $this
     */
    public function setTable($table = '')
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param array $limit
     * @return $this
     */
    public function limit($limit = [])
    {
        $this->limit = $limit;

        return $this;
    }


    /**
     * Mysql veri sıralama sistemini yapar
     *
     * @param        $order
     * @param string $type
     * @return $this
     */
    public function order($order, $type = 'DESC')
    {
        $this->order = $order;
        $this->orderType = $type;

        return $this;
    }

    /**
     * Sorguya set ekler
     *
     * @param array $set
     * @return $this
     */
    public function set(array $set = [])
    {

        $this->set = $set;

        return $this;
    }

    /**
     * Sorguya select kodunu ekler
     *
     * @param array $select
     * @return $this
     */
    public function select(array $select = [])
    {
        $this->select = $select;

        return $this;
    }

    /**
     * paginate the datas
     *
     * @param int $perPage
     * @return \Anonym\Components\Database\Pagination\Paginator|bool
     */
    public function paginate($perPage = 15)
    {
        $builded = $this->buildBaseForRead();

        if ($builded instanceof ModeManager) {
            return $builded->pagination($perPage);
        }else{
            return false;
        }
    }


    /**
     * paginate the datas
     *
     * @param int $perPage
     * @return \Anonym\Components\Database\Pagination\Paginator|bool
     */
    public function simplePaginate($perPage = 15)
    {
        $builded = $this->buildBaseForRead();

        if ($builded instanceof ModeManager) {
            return $builded->simplePagination($perPage);
        }else{
            return false;
        }
    }
    /**
     * Veriyi okur
     *
     * @return mixed
     */
    public function read()
    {

        $return = $this->buildBaseForRead()->build();

        return $return;
    }

    /**
     * fetch mysql datas to object
     *
     * @return mixed
     */
    public function fetch(){
        return $this->read()->fetch();
    }

    /**
     * fetch mysql all datas to object
     *
     * @return mixed
     */
    public function fetchAll(){
        return $this->read()->fetchAll();
    }

    /**
     * run row count command
     *
     * @return mixed
     */
    public function rowCount(){
        return $this->read()->rowCount();
    }

    /**
     *
     */
    private function buildBaseForRead()
    {
        $app = $this;
        $return = $app->db->read(
            $this->table,
            function (Read $mode) use ($app) {
                if (isset($app->where)) {
                    $mode->where($app->where);
                }
                if (isset($app->select)) {
                    $mode->select($app->select);
                }
                if (isset($app->join)) {
                    $mode->join($app->join);
                }
                if (isset($app->group)) {
                    $mode->group($app->group);
                }
                if (isset($app->limit)) {
                    $mode->limit($app->limit);
                }
                if (isset($app->page)) {
                    $mode->page($app->page);
                }
                if (isset($app->order) && isset($app->orderType)) {
                    $mode->order($app->order, $app->orderType);
                }
                if (isset($app->orWhere)) {
                    $mode->orWhere($app->orWhere);
                }

                return $mode;
            }
        );

        return $return;
    }

    /**
     * Mysql üzerinde güncelleme işlemi yapar
     *
     * @return mixed
     */
    public function update()
    {
        $app = $this;

        return $this->db->update(
            $this->table,
            function (Update $mode) use ($app) {
                if (isset($app->where)) {
                    $mode->where($app->where);
                }

                if (isset($app->set)) {
                    $mode->set($app->set);
                }

                return $mode->run();
            }
        );
    }

    /**
     * Veritabanına veri ekleme işlemi yapar
     *
     * @return mixed
     */
    public function insert()
    {
        $app = $this;

        return $this->db->insert(
            $this->table,
            function (Insert $mode) use ($app) {

                if (isset($app->set)) {
                    $mode->set($app->set);
                }

                return $mode->run();
            }
        );
    }

    /**
     * Tüm sorgular başarılı olmasını zorlayan method
     * @throws Exception
     * @return null
     */
    public function beginTransaction()
    {

        $connection = $this->db->getConnection();

        if ($connection instanceof PDO) {
            $connection->beginTransaction();
        } else {
            throw new Exception(sprintf('%s sadece PDO altyapısında çalışabilir', __FUNCTION__));
        }

    }

    /**
     * Tüm sorgular başarılı olmazsa değişiklikleri geri alır
     * @throws Exception
     */
    public function commit()
    {
        $connection = $this->db->getConnection();

        if ($connection instanceof PDO) {
            $connection->commit();
        } else {
            throw new Exception(sprintf('%s sadece PDO altyapısında çalışabilir', __FUNCTION__));

        }
    }

    /**
     * Veritabanndan veri silme işlemi yapar
     *
     * @return mixed
     */
    public function delete()
    {
        $app = $this;

        return $this->db->delete(
            $this->table,
            function (Delete $mode) use ($app) {
                if (isset($app->where)) {
                    $mode->where($app->where);
                }

                return $mode->run();
            }
        );
    }


    /**
     * Dinamik olarak veri toplama
     * @throws Exception
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value = '')
    {
        if (!is_string($name) || !is_string($value)) {
            throw new Exception('isim veya değeri mutlaka string olmalıdır');
        }
        $this->set[$name] = $value;
    }


    /**
     * Dinamik method çağrımı
     * @param $method
     * @param array $params
     * @return mixed
     */
    public function __call($method, $params = [])
    {

        return call_user_func_array([$this->db, $method], $params);
    }
}
