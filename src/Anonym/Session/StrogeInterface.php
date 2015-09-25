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

/**
 * Interface StrogeInterface
 * @package Anonym\Session
 */
interface StrogeInterface
{

    /**
     * return a registered session, return false on session not found
     *
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * register a new session with handler
     *
     * @param string $name the name of session
     * @param mixed $value the value of session, the value can be string, object, integer ...
     * @return $this
     */
    public function set($name = '', $value);

    /**
     * remove a session
     *
     * @param string $name
     * @return $this
     */
    public function delete($name);

    /**
     * clear the all sessions
     *
     * @return $this
     */
    public function flush();
}
