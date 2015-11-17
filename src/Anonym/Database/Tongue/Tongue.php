<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Tongue;

use Anonym\Support\Arr;


/**
 * Class Tongue
 * @package Anonym\Database\Tongue
 */
abstract class Tongue
{

    /**
     * an array type for build query
     *
     * @var array
     */
    protected $datas;

    /**
     * an array type for statements
     *
     * @var array
     */
    private $statements = [

        'read' => [
            'SELECT :select FROM :from :join :group :where :order :limit',
        ],
        'update' => [

            'UPDATE :from SET :update :where'
        ],
        'delete' => [

            'DELETE FROM :from :where'
        ],
        'insert' => [
            'INSERT INTO :from SET :insert'
        ]
    ];

    /**
     * story the where parameters
     *
     * @var array
     */
    protected $parameters = [];
    /**
     * an array type for prepared strings
     *
     * @var array
     */
    protected $strings;

    /**
     * starting the build query
     *
     * @param array $datas
     * @param string $type
     * @return mixed
     */
    public function build($datas, $type)
    {
        $this->datas = $datas;
        $compilerMethodName = 'compile' . ucfirst($type);
        return $this->$compilerMethodName();
    }


    /**
     * run the compilers
     *
     * @param array $compilers
     * @return array
     */
    protected function runTheCompilers($compilers)
    {

        $return = [];
        foreach ($compilers as $compiler) {
            $methodName = 'compiling' . ucfirst($compiler);
            if (Arr::has($this->datas, $compiler) && !empty($this->datas[$compiler])) {
                $return[$compiler] = $this->$methodName(Arr::get($this->datas, $compiler));
            } else {
                $return[$compiler] = '';
            }
        }

        return $return;
    }

    /**
     * preparing the select statement
     *
     * @param mixed $select
     * @return array|string
     */
    protected function compilingSelect($select)
    {

        if (is_string($select)) {
            return $select;
        }

        return join(',', $select);
    }

    /**
     * this method returns itself.
     *
     * @param string $from
     * @return mixed
     */
    protected function compilingFrom($from)
    {
        return $from;
    }

    /**
     * preparing and return group by statement
     *
     * @param string $group
     * @return string
     */
    protected function compilingGroup($group)
    {
        return "GROUP BY $group";
    }

    /**
     * compile and return prepared order by string.
     *
     * @param string $order
     * @return string
     */
    protected function compilingOrder($order)
    {
        list($column, $type) = array_values($order);
        return "ORDER BY $column $type";
    }

    /**
     * compile and return the prepared limit statement
     *
     * @param array|string $limit
     * @return string
     */
    protected function compilingLimit($limit)
    {
        if (is_array($limit)) {
            $limit = join(",", $limit);
        }

        return "LIMIT $limit";
    }

    /**
     * compile and return prepared string value
     *
     * @param array $wheres
     * @return string
     */
    protected function compilingWhere($wheres)
    {
        $statement = "WHERE ";

        if (Arr::has($this->datas, 'like') && !empty($this->datas['like'])) {
            foreach ($this->datas['like'] as $like) {

                list($column, $state, $ending) = $like;
                $statement .= "$column LIKE $state $ending ";
            }

            $statement = rtrim($statement, $ending);
        }

        foreach ($wheres as $where) {

            list($column, $glue, $value, $ending) = $where[0];

            $this->parameters[] = $value;
            $statement .= "$column $glue ? $ending ";
            $this->datas['parameters'][] = $value;
        }
        $statement = rtrim($statement, " $ending ");

        return $statement;
    }


    /**
     * compile and return statement
     *
     * @param array $insert
     * @return string
     */
    protected function compilingInsert($insert)
    {
        return $this->compilingUpdate($insert);
    }

    /**
     * compile and return statement
     *
     * @param array $update
     * @return string
     */
    protected function compilingUpdate($update)
    {
        $statement = '';

        foreach ($update as $item) {
            $statement .= ',' . $item;
        }

        return ltrim($statement, ',');
    }

    /**
     * compile and return the statement
     *
     * @param array $joins
     * @return string
     */
    protected function compilingJoin($joins)
    {
        $statement = '';
        $from = $this->datas['from'];
        foreach ($joins as $type => $value) {
            list($column, $tablealt, $colunalt) = $value;

            $statement .= "$type $column ON $from.$tablealt = $column.$colunalt ";
        }

        return rtrim($statement, ' ');
    }

    /**
     *  compile the read paremeters with the pattern
     *
     *  this function working with the other methods and preparing the select statement
     */
    protected function compileRead()
    {
        $pattern = $this->statements['read'][0];

        $return = call_user_func_array(
            [$this, 'replaceParameters'], [$pattern, $this->runTheCompilers(['select', 'from', 'join', 'group', 'where', 'order', 'limit'])]
        );

        return ['statement' => $return, 'parameters' => Arr::get($this->datas, 'parameters', [])];
    }


    /**
     * compile the update statemenet
     *
     * @return array
     */
    protected function compileUpdate()
    {
        $pattern = $this->statements['update'][0];

        $return = call_user_func_array(
            [$this, 'replaceParameters'], [$pattern, $this->runTheCompilers(['from', 'update', 'where'])]
        );

        return ['statement' => $return, 'parameters' => Arr::get($this->datas, 'parameters', [])];
    }

    /**
     * compile the update statemenet
     *
     * @return array
     */
    protected function compileInsert()
    {
        $pattern = $this->statements['insert'][0];

        $return = call_user_func_array(
            [$this, 'replaceParameters'], [$pattern, $this->runTheCompilers(['from', 'insert',])]
        );

        return ['statement' => $return, 'parameters' => Arr::get($this->datas, 'parameters', [])];
    }

    /**
     * compile the update statemenet
     *
     * @return array
     */
    protected function compileDelete()
    {
        $pattern = $this->statements['delete'][0];

        $return = call_user_func_array(
            [$this, 'replaceParameters'], [$pattern, $this->runTheCompilers(['from', 'where',])]
        );

        return ['statement' => $return, 'parameters' => Arr::get($this->datas, 'parameters', [])];
    }

    /**
     * find and replace each parameters in pattern
     *
     * @param string $pattern
     * @param array $parameters
     * @return string
     */
    protected function replaceParameters($pattern, $parameters)
    {
        foreach ($parameters as $parameter => $value) {
            $parameter = ':' . $parameter;

            $pattern = str_replace($parameter, $value, $pattern);
        }

        return $pattern;
    }
}

