<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Components\Config;

use Anonym\Support\Arr;
use ArrayAccess;

/**
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @copyright AnonymMedya, 2015
 */
class Reposity implements ArrayAccess
{
    /**
     * config repository
     *
     * @var array
     */
    private static $cache;


    /**
     * @return array
     */
    public static function getCache()
    {
        return static::$cache;
    }

    /**
     * @param array $cache
     * @return Reposity
     */
    public static function setCache($cache)
    {
        static::$cache = $cache;
    }


    /**
     * @param string $name
     * @return bool
     */
    public function has($name = '')
    {
        return Arr::has(static::$cache, $name);
    }

    /**
     * İstenilen ayarı döndürür
     *
     * @param string $config
     * @return boolean|mixed
     * @access public
     */
    public function get($config)
    {
        return Arr::get(static::$cache, $config, []);
    }


    /**
     * @param string $name verinin ismi
     * @param string $value değeri
     * @return $this
     */
    public function set($name, $value = '')
    {
        Arr::set(static::$cache, $name, $value);
        return $this;
    }

    /**
     * @param string $name eklenecek değerin ismi
     * @param string $value değeri
     * @return $this
     */
    public function add($name = '', $value = '')
    {
        $array = static::getCache();
        $keys = explode('.', $name);
        while (count($keys) > 1) {
            $key = array_shift($keys);
            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        $array[array_shift($keys)][] = $value;
        return $this;
    }

    /**
     * get all config files
     *
     * @return array
     */
    public function all(){
        return $this->getCache();
    }
    /**
     * Dizi olarak erişilirken itemin olup olmadığına bakılır
     *
     * @param  string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * Dizi olarak erişilirken Veri çekmekte kullanılır
     *
     * @param  string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Dizi olarak erişilirken veri eklemede kullanılır
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Array olarak erişilirken veri unset edildiğinde yapılır
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->set($key, null);
    }
}
