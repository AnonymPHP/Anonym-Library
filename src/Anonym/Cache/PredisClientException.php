<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Cache;
use Exception;

/**
 * Class PredisClientException
 * @package Anonym\Components\Cache
 */
class PredisClientException extends Exception
{

    /**
     * İstisnayı oluştruru
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}
