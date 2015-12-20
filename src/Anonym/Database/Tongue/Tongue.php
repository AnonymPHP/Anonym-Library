<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Tongue;

use Anonym\Database\Database;
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
            'INSERT INTO :from :insert'
        ],

        'advanced' => [
            'SHOW TABLE LIKE :from;',
            'SHOW COLUMNS FROM `:from` LIKE \':column\';',
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
     * @return mixed
     */
    public function build($datas)
    {
        $this->datas = $datas;

        if (isset($this->datas['update']) && $this->datas['update'] === true) {
            $type = 'update';
        } elseif (isset($this->datas['insert']) && $this->datas['insert'] === true) {
            $type = 'insert';
        } elseif (isset($this->datas['select']) && !empty($this->datas['select'])) {
            $type = 'read';
        } elseif (isset($this->datas['delete']) && $this->datas['delete'] === true) {
            $type = 'delete';
        } elseif (isset($this->datas['advanced']) && $this->datas['advanced'] === true) {
            $type = "advanced";
        }

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
        if (is_string($from)) {
            return $from;
        } elseif (is_array($from)) {
            return implode(",", $from);
        } else {
            return (string)$from;
        }
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

            if (is_string($value)) {
                $this->parameters[] = $value;
                $statement .= "$column $glue ? $ending ";
                $this->datas['parameters'][] = $value;
            } elseif (is_array($value)) {
                $filled = array_fill(0, count($value) - 1, '?');

                if ($glue === '=') {
                    $glue = 'IN';
                } elseif ($glue === '!=') {
                    $glue = 'NOT IN';
                }
                $stat = join(',', $filled);
                $statement .= "$column $glue ($stat)";
                $this->datas['parameters'] = array_merge($this->datas['parameters'], $value);
            } elseif ($value instanceof Database) {

            }

        }
        $statement = rtrim($statement, " $ending ");

        return $statement;
    }

    protected function matchGlue($glue)
    {
        if ($glue === '=') {
            $glue = 'IN';
        } elseif ($glue === '!=') {
            $glue = 'NOT IN';
        }
        return $glue;
    }

    /**
     * compile and return statement
     *
     * @param array $insert
     * @return string
     */
    protected function compilingInsert($insert)
    {
        $first = $insert[0];
        $tables = array_keys($first);
        $tables = join(",", $tables);

        $statement = "($tables) VALUES ";

        foreach ($insert as $items) {
            $statement .= "(";
            foreach ($items as $value) {
                $this->datas['parameters'][] = $value;
                $statement .= "?,";
            }

            $statement = rtrim($statement, ",") . "),";
        }

        return rtrim($statement, ',');
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
     * compile advanced patterns with given datas
     */
    protected function compileAdvanced()
    {
        if (isset($this->datas['table_exists'])) {
            $pattern = $this->statements['advanced'][0];

            $return = call_user_func_array(
                [$this, 'replaceParameters'], [$pattern, $this->replaceParameters(['from'])]
            );

            return ['statement' => $return, 'parameters' => []];
        } else {
            $pattern = $this->statements['advanced'][1];

            $return = call_user_func_array(
                [$this, 'replaceParameters'], [$pattern, array_merge($this->runTheCompilers(['from']), ['column' => $this->datas['columnExists']])]
            );

            return ['statement' => $return, 'parameters' => []];
        }
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

        $this->datas['update'] = $this->datas['set'];

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
        $this->datas['insert'] = $this->datas['set'];
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

