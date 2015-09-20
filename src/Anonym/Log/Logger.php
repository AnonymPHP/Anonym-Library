<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Log;
use Exception;
use Anonym\Filesystem\Filesystem;

/**
 * Class Logger
 * @package Anonym\Log
 */
class Logger
{

    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    private $filesystem;

    /**
     * the default path to log file
     *
     * @var string
     */
    private $path;
    /**
     * create a new instance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem, $path = APP.'logs/error.log'){
        $this->filesystem = $filesystem;
        $this->path = $path;
    }

    /**
     * write error to error.log
     *
     * @param Exception $exception
     */
    public function write(Exception $exception){

        $pattern = "[%s] = %s : %s-%d";
        $time = date('d.m.Y- h:i');
        $content = sprintf($pattern, $time, $exception->getMessage(), $exception->getFile(), $exception->getLine());

        $this->filesystem->append($this->path, $content);
    }
}


