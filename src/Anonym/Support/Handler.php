<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Support;

use Exception;
use HttpException;
use ErrorException;
use Anonym\Filesystem\Filesystem;


/**
 * Class Handler
 * @package Anonym\Support
 */
class Handler
{

    /**
     * @var Filesystem
     */
    private $file;

    /**
     * create a new instance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->file = $filesystem;
    }

    /**
     * convert to errors to exceptions
     *
     * @param int $code
     * @param string $message
     * @param string $file
     * @param int $line
     * @throws ErrorException
     */
    public function handleErrors($code, $message, $file, $line)
    {

        // throw a new error.
        throw new ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param Exception $e
     * @return mixed
     */
    public function handleExceptions(Exception $e)
    {

    }

    /**
     * @param string $content
     * @param string $css
     * @param string $charset
     * @return string
     */
    protected function decoreate($content, $css, $charset)
    {
        $stub = $this->file->get(__DIR__ . '/stubs/error.decorate.stub');
        $manager = new TemplateGenerator($stub);

        return $manager->generate([
            'content' => $content,
            'css'       => $css,
            'charset'  => $charset
        ]);
    }

    /**
     * determine the given exception is an http exception
     *
     * @param Exception $e
     * @return bool
     */
    protected function isHttpException(Exception $e)
    {
        return $e instanceof HttpException;
    }
}
