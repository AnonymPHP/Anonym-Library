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
 * Class DriverAdapter
 * @package Anonym\Components\Cache
 */
class DriverAdapter implements DriverAdapterInterface
{

    /**
     *Sürücünün objesini tutar
     *
     *
     * @var  DriverInterface-> adapter
     */
    private $adapter;

    /**
     * Sürücüyü kullanır
     *
     * @param DriverAdapterInterface|null $adapter
     */
    public function __construct(DriverAdapterInterface $adapter = null)
    {
        $this->adapter = $adapter;
    }
    /**
     * Verinin değerini döndürür
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->adapter->get($name);
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
        return $this->adapter->set($name, $value, $time);
    }

    /**
     * @param string $name Değer ismi
     * @return $this
     */
    public function delete($name)
    {
        return $this->adapter->delete($name);
    }

    /**
     * Önbelleğe alınan tüm verileri siler
     * @throws DriverNotFlushableException
     * @return mixed
     */
    public function flush()
    {

        if ($this->adapter instanceof FlushableInterface) {
            return $this->adapter->flush();
        } else {
            throw new DriverNotFlushableException('%s sürücünüz flushable değildir', get_class($this->adapter));
        }
    }

    /**
     * Öyle bir değerin olup olmadığına bakar
     *
     * @param string $name
     * @return mixed
     */
    public function exists($name)
    {
        return $this->adapter->exists($name);
    }
}
