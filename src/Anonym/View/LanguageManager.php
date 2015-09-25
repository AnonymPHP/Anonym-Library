<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */
namespace Anonym\Components\View;
/**
 * the class of language manager
 *
 * Class LanguageManager
 * @package Anonym\Components\View
 */
class LanguageManager
{
    /**
     * the path of language files
     *
     * @var string
     */
    private $path;

    /**
     * create a new instance and store the language files path
     *
     * @param string $path
     */
    public function __construct($path = '')
    {
        $this->path = $path;
    }
    /**
     * get the language variables with file path
     *
     * @param string $file the file name
     * @return array|bool registered varibles on file
     */
    public function getLanguage($file = '')
    {
        $path = $this->path . DIRECTORY_SEPARATOR . $file . '.php';
        if (file_exists($path)) {
            $variables = require $path;
            return $variables;
        } else {
            return false;
        }
    }
}