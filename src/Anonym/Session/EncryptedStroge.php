<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Session;

/**
 * Class EncryptedStroge
 * @package Anonym\Components\Session
 */
class EncryptedStroge extends Stroge
{


    /**
     * return a registered session, return false on session not found
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->readFromHandler($name, true);
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
        $this->registerToHandler($name, $value, true);

        return $this;
    }

}
