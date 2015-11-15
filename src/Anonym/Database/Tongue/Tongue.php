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

            'UPDATE :from SET :update WHERE:where'
        ],
        'delete' => [

            'DELETE FROM :from WHERE:where'
        ],
        'insert' => [
            'INSERT INTO :from SET :insert'
        ]
    ];


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

            $return[] = $this->$methodName($this->datas[$compiler]);
        }

        return $return;
    }

    /**
     *  compile the read paremeters with the pattern
     *
     *  this function working with the other methods and preparing the select statement
     */
    protected function compileRead()
    {
        $pattern = $this->statements['read'][0];

        return call_user_func_array(
            'sprintf',
            array_merge($pattern, $this->runTheCompilers(['select', 'from', 'join', 'group', 'where', 'order', 'limit']))
        );

    }
}

