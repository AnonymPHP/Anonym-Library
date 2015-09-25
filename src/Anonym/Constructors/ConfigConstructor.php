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
class ConfigConstructor
{


    /**
     * create a new instance and set the configs
     *
     */
    public function __construct(Application $application)
    {

        $cachedPath = $application->getSystemPath() . 'cached_configs.php';

        $application->singleton('config', function () use ($application, $cachedPath) {

            $return = null;
            $driver = $application->getGeneral()['config'];
            $loaded = (new ConfigLoader($application->getConfigPath(), $cachedPath))->loadConfigs();

            switch ($driver) {
                case 'memcache':
                    $memcache = new MemcacheDriver();
                    $memcache->boot(Arr::get($loaded, 'stroge.cache.memcache', []));

                    $return = MemcacheReposity($loaded, $memcache->getDriver());
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

            return $return;
        });


        $configs = $loader->loadConfigs();
        Reposity::setCache($configs);

        // we will set default timezone
        date_default_timezone_set($configs['general']['timezone']);
    }

}
