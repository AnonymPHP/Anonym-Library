<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Event;
use Exception;


/**
 * Class EventListenerException
 * @package Anonym\Event
 */
class EventListenerException extends Exception
{

    /**
     * Sınıfı başlatır ve istisnayı oluşturur
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

}
