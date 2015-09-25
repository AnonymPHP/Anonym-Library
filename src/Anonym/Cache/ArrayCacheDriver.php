<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Cache;

/**
 * Class ArrayCacheDriver
 * @package Anonym\Components\Cache
 */
class ArrayCacheDriver implements DriverAdapterInterface,
    DriverInterface,
    FlushableInterface
{

    /**
     * Verileri depolar
     *
     *
     * @var array -> data
     */
    private static $data;

    /**
     * Verinin değerini döndürür
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return static::$data[$name];
    }

    /**
     * Veri ataması yapar
     *
     * @param string $name
     * @param mixed $value
     * @param int $time
     * @return mixed
     */
    public function set($name, $value, $time = 3600)
    {
        static::$data[$name] = $value;
        return $this;
    }

    /**
     * @param string $name Değer ismi
     * @return mixed
     */
    public function delete($name)
    {
        unset(static::$data[$name]);
        return $this;
    }

    /**
     * Öyle bir değerin olup olmadığına bakar
     *
     * @param string $name
     * @return mixed
     */
    public function exists($name)
    {
        return isset(static::$data[$name]) || array_key_exists($name, static::$data);
    }

    /**
     *
     *
     * @return bool
     */
    public function check()
    {

        return true;
    }

    /**
     * Ayarları kullanır ve bazı başlangıç işlemlerini gerçekleştirir
     *
     * @param array $configs
     * @return mixed
     */
    public function boot(array $configs = [])
    {

        // do it array
        static::$data = [];
    }

    /**
     * Önbelleğe alınan tüm verileri siler
     *
     * @return mixed
     */
    public function flush()
    {
        static::$data = [];
        return $this;
    }

    /**
     * @return array
     */
    public static function getData()
    {
        return self::$data;
    }

    /**
     * @param array $data
     */
    public static function setData($data)
    {
        self::$data = $data;
    }
}
