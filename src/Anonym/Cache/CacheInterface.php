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
 * Interface CacheInterface
 * @package Anonym\Components\Cache
 */
interface CacheInterface
{

    /**
     * Sürücü seçimini yapar
     *
     * @param string $driver
     * @param array $configs
     * @return mixed
     */
    public function driver($driver = '', array $configs = []);
}
