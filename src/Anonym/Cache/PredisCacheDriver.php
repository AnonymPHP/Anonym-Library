<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Cache;

use Exception;
use Predis\Client as PredisClient;

/**
 * Class PredisCacheDriver
 * @package Anonym\Components\Cache
 */
class PredisCacheDriver implements DriverAdapterInterface,
    DriverInterface,
    FlushableInterface
{

    /**
     * Predis objesini tutar
     *
     *
     * @var  PredisClient-> predis
     */
    private $predis;

    /**
     * Verinin değerini döndürür
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->getPredis()->get($name);
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
        return $this->getPredis()->set($name, $value, null, $time);
    }

    /**
     * @param string $name Değer ismi
     * @return mixed
     */
    public function delete($name)
    {
        return $this->getPredis()->del($name);
    }

    /**
     * Önbelleğe alınan tüm verileri siler
     *
     * @return mixed
     */
    public function flush()
    {
        return $this->getPredis()->flushall();
    }

    /**
     * Öyle bir değerin olup olmadığına bakar
     *
     * @param string $name
     * @return mixed
     */
    public function exists($name)
    {
        return $this->getPredis()->exists($name);
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
     * @throws PredisClientException
     * @return mixed
     */
    public function boot(array $configs = [])
    {
        try {
            $redis = new PredisClient($configs);
        } catch (Exception $e) {
            throw new PredisClientException('Predis sınıfınız düzgün olarak başlatılamadı');
        }

        $this->setPredis($redis);
    }

    /**
     * @return PredisClient
     */
    public function getPredis()
    {
        return $this->predis;
    }

    /**
     * @param PredisClient $predis
     * @return PredisCacheDriver
     */
    public function setPredis(PredisClient $predis)
    {
        $this->predis = $predis;
        return $this;
    }
}
