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


use Anonym\Bootstrap\Container;
use Anonym\Components\HttpClient\Response;

/**
 * Class ErrorListener
 * @package Anonym\Support
 */
class ErrorListener extends Container
{

    /**
     * the instance of any exception
     *
     * @var \Exception
     */
    private $exception;

    /**
     * create a new instance and register the exception
     *
     * @param mixed $exception
     */
    public function __construct($exception)
    {
        $this->setException($exception);
    }

    /**
     * @return mixed
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param mixed $exception
     * @return ErrorListener
     */
    public function setException($exception)
    {
        $this->exception = $exception;
        return $this;
    }


    /**
     * send the exception message
     *
     * @throws \Anonym\Bootstrap\BindNotFoundException
     * @throws \Anonym\Bootstrap\BindNotRespondingException
     * @throws \Anonym\Components\HttpClient\HttpResponseException
     */
    public function send()
    {
        $response = new Response();
        $generator = new TemplateGenerator(file_get_contents(RESOURCE . 'migrations/errors/exception.mig.php'));
        $params = [
            'file'    => $this->exception->getFile(),
            'message' => $this->exception->getMessage(),
            'line'    => $this->exception->getLine(),
            'code'    => $this->exception->getCode(),
            'trace' => method_exists($this->getException(), 'getTraceAsString') ? $this->exception->getTraceAsString() : ''
        ];
        $content = $generator->generate($params);

        // is loglistener is registered
        if (LogListener::isRegistered()) {
            LogListener::sendLog($params);
        }
        $response->setContent($content);
        $response->send();
    }
}
