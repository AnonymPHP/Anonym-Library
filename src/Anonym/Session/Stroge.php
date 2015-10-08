<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Session;

use SessionHandlerInterface;
use Anonym\Crypt\CryptInterface;
/**
 * Class Stroge
 * @package Anonym\Session
 */
class Stroge implements StrogeInterface
{

    /**
     * the instance of handler
     *
     * @var SessionHandlerInterface
     */
    private $handler;

    /**
     * all configs of the handlers
     *
     * @var array
     */
    private $configs;


    /**
     * the instance of anonym crypt
     *
     * @var CryptInterface
     */
    protected $crypt;

    /**
     * create a new instance and save handler settings
     *
     * @param array $configs all settings of the handler
     * @param SessionHandlerInterface|null $handlerInterface the instance of  the handler
     * @param Crypter $crypt
     */
    public function __construct(array $configs = [], SessionHandlerInterface $handlerInterface = null,CryptInterface $crypt = null)
    {
        $this->setConfigs($configs);
        $this->setHandler($handlerInterface);
        $this->setCrypt($crypt);
    }

    /**
     * @return SessionHandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param SessionHandlerInterface $handler
     * @return Stroge
     */
    public function setHandler(SessionHandlerInterface $handler = null)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @param array $configs
     * @return Stroge
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * @return CryptInterface
     */
    public function getCrypt()
    {
        return $this->crypt;
    }

    /**
     * @param CryptInterface $crypt
     * @return Stroge
     */
    public function setCrypt(CryptInterface $crypt)
    {
        $this->crypt = $crypt;

        return $this;
    }

    /**
     * read a session from session handle
     *
     * @param string $name the name of session
     * @param bool|false $crypt
     * @return string|false
     */
    protected function readFromHandler($name, $crypt = false)
    {
        $value = $this->getHandler()->read($name);

        if (true === $crypt) {
            $value = $this->getCrypt()->decode($value);
        }

        if (false !== $data = @unserialize(base64_decode($value))) {
            return $data;
        }
        return $value;
    }


    /**
     * register a new session to handler
     *
     * @param string $name
     * @param mixed $value
     * @param bool|false $crypt
     */
    protected function registerToHandler($name, $value, $crypt = false)
    {
        if (is_array($value) || is_object($value)) {
            $value = base64_encode(serialize($value));
        }

        if (true === $crypt) {
            $value = 'serialized:'.$this->getCrypt()->encode($crypt);
        }

        $this->getHandler()->write($name, $value);
    }

    /**
     * return a registered session, return false on session not found
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->readFromHandler($name);
    }

    /**
     * register a new session with handler
     *
     * @param string $name the name of session
     * @param mixed $value the value of session, the value can be string, object, integer ...
     * @return $this
     */
    public function set($name = '', $value)
    {
        $this->registerToHandler($name, $value, false);

        return $this;
    }

    /**
     * remove a session
     *
     * @param string $name
     * @return $this
     */
    public function delete($name)
    {
        $this->getHandler()->destroy($name);

        return $this;
    }

    /**
     * check the value is exists
     *
     * @return mixed
     */
    public function has($name)
    {
        $value = $this->get($name);

        return isset($value) ? $value : false;
    }

    /**
     * clear the all sessions
     *
     * @return $this
     */
    public function flush()
    {
         // do nothing
    }
}
