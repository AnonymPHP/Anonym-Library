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
use ErrorException;
use Anonym\Log\Logger;
use Anonym\Facades\Config;
use Anonym\Filesystem\Filesystem;
use Anonym\Bootstrap\HttpException;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler;

/**
 * Class Handler
 * @package Anonym\Support
 */
class Handler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontLog = [
        HttpException::class,
    ];

    /**
     * the error logger
     *
     * @var Logger
     */
    protected $logger;

    /**
     * @var Filesystem
     */
    private $file;

    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * the bool type to debugging
     *
     * @var bool
     */
    private $debug;

    /**
     * @var bool
     */
    private $log;


    /**
     * create a new instance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->file = $filesystem;
        $this->logger = new Logger($filesystem);
    }

    /**
     * @return boolean
     */
    public function isLog()
    {
        return $this->log;
    }

    /**
     * @param boolean $log
     * @return Handler
     */
    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }

    /**
     *
     *
     * @return $this
     */
    public function fire(){
        $this->exceptionHandler = ExceptionHandler::register($this->isDebug());
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     * @return Handler
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
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
        throw new ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param Exception $e
     * @return mixed
     */
    public function handleExceptions(Exception $e)
    {

        if ($this->shouldBeLog($e)) {
            $this->writeToLog($e);
        }

        if ($this->isHttpException($e)) {
            $response = $this->generateHttpExceptionResponse($e);
        } else {
            $response = $this->generateExceptionResponse($e);
        }

        $response->send();
    }


    /**
     * @param HttpException $e
     * @return mixed
     */
    protected function generateHttpExceptionResponse(HttpException $e)
    {
        $statusCode = $e->getStatusCode();

        if(view()->exists("errors.{$statusCode}")){
            $content = view("errors.{$statusCode}", [
                'message' => $e->getMessage()
            ]);

            return response($content->render(), $statusCode)->setHeaders($e->getHeaders());
        }else{
            return $this->generateExceptionResponse($e);
        }
    }

    /**
     * create response objecto to exception message
     *
     * @param Exception $e
     * @return mixed
     */
    protected function generateExceptionResponse(Exception $e){

        $e = FlattenException::create($e);
        $content = $this->decoreate($this->exceptionHandler->getContent($e), $this->exceptionHandler->getStylesheet($e), 'utf-8');

        return response($content, 500);
    }

    /**
     * Determine if the exception should be reported.
     *
     * @param Exception $e
     * @return bool
     */
    protected function shouldBeLog($e)
    {
        foreach ($this->dontLog as $instance) {
            if ($e instanceof $instance) {
                return false;
            }
        }

        return true;
    }

    /**
     * write your exception to log
     *
     * @param Exception $e
     */
    protected function writeToLog(Exception $e)
    {
        $this->logger->write($e);
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
            'css' => $css,
            'charset' => $charset
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
