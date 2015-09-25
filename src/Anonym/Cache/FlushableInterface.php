<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Cache;

/**
 * Interface FlushableInterface
 * @package Anonym\Cache
 */
interface FlushableInterface
{
    /**
     * Önbelleğe alınan tüm verileri siler
     *
     * @return mixed
     */
    public function flush();
}
