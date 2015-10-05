<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Constructors;

use Anonym\Application\Application;
use Anonym\Application\ServiceProvider;
use Anonym\Cache\MemcacheDriver;
use Anonym\Cache\RedisCacheDriver;
use Anonym\Config\ApcReposity;
use Anonym\Config\ConfigLoader;
use Anonym\Config\MemcacheReposity;
use Anonym\Config\RedisReposity;
use Anonym\Config\Reposity;
use Anonym\Config\XcacheReposity;
use Anonym\Support\Arr;

/**
 * the config constructor
 *
 * Class ConfigConstructor
 * @package Anonym\Constructors
 */
class ConfigConstructor extends ServiceProvider
{

    /**
     * run the application
     */
    public function register()
    {

        $cachedPath = $this->getSystemPath() . 'cached_configs.php';

        $this->singleton('config', function () use ($this, $cachedPath) {

            $return = null;
            $loaded = (new ConfigLoader($this->getConfigPath(), $cachedPath))->loadConfigs();

            $driver = Arr::get($loaded, 'general.config');
            switch ($driver) {
                case 'memcache':
                    $memcache = new MemcacheDriver();
                    $memcache->boot(Arr::get($loaded, 'stroge.cache.memcache', []));

                    $return = new MemcacheReposity($loaded, $memcache->getDriver());
                    break;

                case 'redis':
                    $redis = new RedisCacheDriver();
                    $redis->boot(Arr::get($loaded, 'stroge.cache.redis'));

                    $return = new RedisReposity($loaded, $redis->getRedis());
                    break;

                case 'xcache':
                    $return = new XcacheReposity($loaded);
                    break;
                case 'apc':
                    $return = new ApcReposity($loaded);
                    break;

                case 'standart':
                    $return = new Reposity($loaded);
                    break;
            }

            date_default_timezone_set(Arr::get($loaded, 'general.timezone'));


            return $return;
        });


        // we will set default timezone
    }

}
