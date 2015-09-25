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
 * Class ZendDataCache
 * @package Anonym\Components\Cache
 */
class ZendDataCache implements DriverAdapterInterface,
    DriverInterface,
    FlushableInterface
{

    /**
     * Verinin değerini döndürür
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return zend_shm_cache_fetch($name);
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
        return zend_shm_cache_store($name, $value, $time);
    }

    /**
     * @param string $name Değer ismi
     * @return mixed
     */
    public function delete($name)
    {
        return zend_shm_cache_delete($name);
    }

    /**
     * Önbelleğe alınan tüm verileri siler
     *
     * @return mixed
     */
    public function flush()
    {
        return zend_shm_cache_clear();
    }

    /**
     * Öyle bir değerin olup olmadığına bakar
     *
     * @param string $name
     * @return mixed
     */
    public function exists($name)
    {
        return (false !== $this->get($name));
    }

    /**
     * Zend data cache in kurulu olup olmadığını kontrol eder
     *
     * @return bool
     */
    public function check()
    {
        return function_exists('zend_shm_cache_fetch');
    }

    /**
     * Ayarları kullanır ve bazı başlangıç işlemlerini gerçekleştirir
     *
     * @param array $configs
     * @return mixed
     */
    public function boot(array $configs = [])
    {
        //
    }
}
