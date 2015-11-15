<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Database\Tongue;


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
     * an array type for compareNames
     *
     * @var array
     */
    protected $compares = [
        "select",
        "join",
        "where",
        "update",
        "insert",
        "order",
        "limit"
    ];

    /**
     * an array type for statements
     *
     * @var array
     */
    private $statements = [

        'read' => [

            'SELECT :select FROM :from :join :group WHERE:where :order :limit',
            'SELECT :select FROM :from :join :group :order :limit'
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
     * an array type to selected pattern
     *
     * @var array
     */
    protected $selectedPatterns;

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

        $this->selectedPatterns = $this->statements[$type];

        foreach ($this->compares as $compare) {
            if (isset($datas[$compare]) && !empty($datas[$compare])) {
                $method = 'compare'.ucfirst($compare);

                $this->$method($datas[$compare]);
            }
        }
    }

    /**
     * @param array $where
     */
    protected function compareWhere($where){

    }


}
