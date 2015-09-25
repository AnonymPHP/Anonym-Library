<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Components\Tools;


/**
 * Class Table
 * @package Anonym\Components\Tools
 */
class Table implements TableInterface
{

    /**
     * Eşleştirilecek yapıları tutar
     *
     * @var array
     */
    private $patterns = [
        'create' => 'CREATE TABLE IF NOT EXISTS `%s`(',
        'auto_increment' => '`%s` INT(%d) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
        'int' => '`%s` INT(%d)',
        'varchar' => '`%s` VARCHAR(%d)',
        'timestamp' => '`%s` TIMESTAMP',
        'current' => '`%s` TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'date' => '`%s` DATE',
        'year' => '`%s` YEAR',
        'time' => '`%s` TIME',
        'datetime' => '`%s` DATETIME',
        'text' => '`%s` TEXT',
        'end' => ') DEFAULT CHARSET=%s;',
        'drop' => 'DROP TABLE `%s`;'
    ];

    /**
     * Karekter setini tutar
     *
     * @var string
     */
    private $charset = 'utf8';

    /**
     * the name of table gonna create
     *
     * @var string
     */
    private $table;


    /**
     * register the default charset
     *
     * @param string $set
     * @return $this
     */
    public function charset($set = 'utf8'){
        $this->charset = $set;
        return $this;
    }
    /**
     * register the table name
     *
     * @param string $name
     * @return $this
     */
    public function create($name){
        $this->table = $name;
        return $this;
    }
    /**
     * add a text string to value
     *
     * @param string $name
     * @return Chield
     */
    public function text($name)
    {
        return $this->addCommand('text', $this->madeArray($name));
    }

    /**
     * add a new varchar command
     *
     * @param string $name
     * @param int $limit
     * @return Chield
     */
    public function varchar($name, $limit = 255){
        return $this->addCommand('varchar', $this->madeArray($name, $limit));
    }


    /**
     * add a new date command
     *
     * @param  string $name
     * @return Chield
     */
    public function date($name){
        return $this->addCommand('date', $this->madeArray($name));
    }

    /**
     * get all args
     *
     * @param mixed $param
     * @return array
     */
    private function madeArray($param){
        return func_num_args() === 1 ? [$param] : func_get_args();
    }

    /**
     * build blueprint command
     *
     * @param string $type
     * @param array $variables
     * @return Chield
     */
    private function addCommand($type, $variables){
        return Blueprint::command(new Chield($this, $this->patterns[$type], $variables) );
    }

    /**
     * create sql string
     *
     * @return string
     */
    public function fetch(){


        $content = isset($this->table) ? sprintf($this->patterns['create'], $this->table) : '';

        foreach(Blueprint::getCommand() as $command){

            $content .= $command->rende();
        }

        $content = rtrim($content, ',');

        $content .= sprintf($this->patterns['end'], $this->charset);
        return $content;
    }


    /**
     * drop a table
     *
     * @param string $name
     * @return string
     */
    public function drop($name){
        return sprintf($this->patterns['drop'], $name);
    }
    /**
     * add a new integer command
     *
     * @param string $name
     * @param int $limit
     * @return Chield
     */
    public function int($name, $limit = 255)
    {
         return $this->addCommand('int', $this->madeArray($name, $limit));
    }

    /**
     * add a new time string
     *
     * @param string $name
     * @return Chield
     */
    public function time($name)
    {
        return $this->addCommand('time', $this->madeArray($name));
    }

    /**
     * add a new timestamp column to mysql
     *
     * @param string $name
     * @return Chield
     */
    public function timestamp($name)
    {
        return $this->addCommand('timestamp', $this->madeArray($name));
    }

    /**
     * add a new year year column to mysql
     *
     * @param string $name
     * @return Chield
     */
    public function year($name)
    {
        return $this->addCommand('year', $this->madeArray($name));
    }

    /**
     * add a new auto_increment column to mysql
     *
     * @param string $name
     * @param int $limit
     * @return mixed
     */
    public function primary($name, $limit = 255)
    {
        return $this->addCommand('auto_increment', $this->madeArray($name, $limit));
    }

    /**
     * add a new time stamp with CURRENT_TIMESTAMP
     *
     * @param string $name
     * @return Chield
     */
    public function current($name){
        return $this->addCommand('current', $this->madeArray($name));
    }
}
