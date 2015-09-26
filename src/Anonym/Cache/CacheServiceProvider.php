<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Cache;
use Anonym\Application\ServiceProvider;
use Anonym\Facades\Config;
/**
 * service provider of cache component
 *
 * Class CacheServiceProvider
 * @package Anonym\Cache
 */
class CacheServiceProvider extends ServiceProvider
{

    /**
     *
     * register the cache provider
     *
     */
    public function register()
    {
        $this->singleton('cache', function () {
            $configs = Config::get('stroge.cache');
            $driver = isset($configs['driver']) ? $configs['driver'] : 'file';

            return (new Cache())->driver($driver, $configs);
        });
    }
}
