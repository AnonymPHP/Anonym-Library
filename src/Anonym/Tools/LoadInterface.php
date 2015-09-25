<?php

/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Database\Tools;

/**
 * Interface LoadInterface
 * @package Anonym\Database\Tools\Backup
 */
interface  LoadInterface
{


    /**
     * Yedeklenmiş verileri geri yükler
     *
     * @param string $name geri yüklenecek dosya ismidir, eğer girilmesze hepsi yüklenir
     * @return mixed
     */
    public function execute($name = '');
}
