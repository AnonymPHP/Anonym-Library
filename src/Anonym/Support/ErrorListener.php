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
     * @param \Exception $exception
     */
    public function __construct($exception)
    {
        $this->setException($exception);
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param \Exception $exception
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
        $response = $this->make('http.response');
        $generator = new TemplateGenerator(file_get_contents(RESOURCE . 'migrations/exception.mig.php'));
        $content = $generator->generate(
            [
                'file'    => $this->exception->getFile(),
                'message' => $this->exception->getMessage(),
                'line'    => $this->exception->getLine(),
                'code'    => $this->exception->getCode(),
                'trace'   => $this->exception->getTraceAsString()
            ]
        );

        if ($response instanceof Response) {
            $response->setContent($content);
            $response->send();
        }
    }
}

