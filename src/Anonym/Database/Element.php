<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database;

/**
 * Class Model
 * @package Anonym\Database
 */
class Element
{
    /**
     * the instance of database
     *
     * @var Database
     */
    private $database;

    /**
     * @var array
     */
    private $vars;

    /**
     * @var string
     */
    private $defaultTCreatedAt = 'created_at';

    /**
     * @var string
     */
    private $defaultTEndsAt = 'ends_at';

    /**
     * the constructor of Model .
     */
    public function __construct()
    {
        $this->vars = get_class_vars(self::class);

        $this->findDefaultValues()
            ->getSelect()
            ->getFrom()
            ->getCreatedAndEndsAt();

        $this->database = new Database($this->findSelectedTable());
    }


    /**
     * get select value
     *
     * @return $this
     */
    private function getSelect()
    {
        if (isset($this->vars['select'])) {
            $this->database->select($this->vars['select']);
        }

        return $this;
    }

    /**
     * get from value and query it
     *
     * @return $this
     */
    private function getFrom()
    {
        if (isset($this->vars['from'])) {
            $this->database->from($this->vars['from']);
        }

        return $this;
    }

    /**
     * get created and ends at values and select them
     *
     * @return $this
     */
    private function getCreatedAndEndsAt()
    {
        if (isset($this->vars[$this->defaultTCreatedAt])) {
            $this->database->select($this->vars[$this->defaultTCreatedAt]);
        }

        if (isset($this->vars[$this->defaultTEndsAt])) {
            $this->database->select($this->vars[$this->defaultTEndsAt]);
        }

        return $this;
    }

    /**
     *  find and replace default values
     */
    private function findDefaultValues()
    {
        if (isset($this->vars[$this->defaultTCreatedAt]) && is_string($this->vars[$this->defaultTCreatedAt])) {
            $this->defaultTCreatedAt = $this->vars[$this->defaultTCreatedAt];
        }

        if (isset($this->vars[$this->defaultTEndsAt]) && is_string($this->vars[$this->defaultTEndsAt])) {
            $this->defaultTEndsAt = $this->vars[$this->defaultTEndsAt];
        }

        return $this;
    }

    /**
     *
     * @return string
     */
    private function findSelectedTable()
    {
        $vars = $this->vars;

        if (isset($vars['table']) && !empty($vars['table'])) {
            $table = $vars['table'];
        } else {
            $referer = new ReflectionObject($this);
            $table = strtolower($referer->getShortName());
        }

        return $table;
    }

    /**
     * call a static method
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __callStatic($name, $arguments)
    {
        return call_user_func_array([new self(), $name], $arguments);
    }
}