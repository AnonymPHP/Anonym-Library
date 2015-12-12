<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Benchmark;

/**
 * Class Benchmark
 * @package Anonym\Benchmark
 */
class Benchmark
{

    /**
     * @var $memoryusage         Ram Kullanımını Ölçer
     */
    public $memoryusage;
    /**
     * @var $microtime           Zamanı ölçer
     */
    public $microtime;

    /**
     * Yeni bir zaman dilimi oluşturur
     * @param unknown $name
     * @return \Myfc\Benchmark
     */

    public function micro($name)
    {
        $this->microtime[$name] = microtime();
        return $this;
    }

    /**
     * zaman farkını ayarlar
     * @param  $baslangic
     * @param  $son
     * @param integer $decimals
     * @return string
     */
    public function elapsedTime($baslangic, $son, $decimals = 4)
    {
        list($start1, $start2) = explode(' ', $this->microtime[$baslangic]);
        list($finish2, $finish3) = explode(' ', $this->microtime[$son]);
        $start = $start1 + $start2;
        $finish = $finish2 + $finish3;
        return number_format(($finish - $start), $decimals);
    }

    /**
     * Ram kullan�m�n� �l�er
     * @param unknown $name
     * @return $this
     */
    public function memory($name)
    {
        $this->memoryusage[$name] = memory_get_usage(true);
        return $this;
    }

    /**
     * Ram kullanımını karşılaştırır
     * @param unknown $start
     * @param unknown $finish
     * @return Ambigous <number, boolean>
     */
    public function usedMemory($start, $finish)
    {
        @$start = $this->memoryusage[$start];
        @$finish = $this->memoryusage[$finish];
        return (isset($start) && isset($finish)) ? $finish - $start : false;
    }

    /**
     * �nclude edilen dosyalar� getirir
     * @return multitype:
     */
    public function includedFiles()
    {
        if (function_exists('get_included_files')) return get_included_files();
    }
}