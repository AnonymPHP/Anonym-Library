<?php

namespace Anonym\Cache;

/**
 * Interface DriverInterface
 * @package Anonym\Cache
 */
interface DriverInterface
{

    /**
     *
     *
     * @return bool
     */
    public function check();

    /**
     * Ayarları kullanır ve bazı başlangıç işlemlerini gerçekleştirir
     *
     * @param array $configs
     * @return mixed
     */
    public function boot(array $configs = []);
}
