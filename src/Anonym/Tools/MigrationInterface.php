<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Components\Tools;

/**
 * Interface MigrationInterface
 * @package Anonym\Components\Tools\MigrationDatabase\Tools\Migration
 */
interface MigrationInterface
{

    /**
     * Eklenecek verileri bu fonksiyon içinde ayarlarız
     *
     * @return mixed
     */
    public function up();

    /**
     * Silinecek verileri bu fonksiyon içinde ayarlarız
     *
     * @return mixed
     */
    public function down();
}
