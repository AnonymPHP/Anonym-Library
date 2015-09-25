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

use Anonym\Components\Cache\DriverAdapterInterface as CacheDriverInterface;
use Anonym\Components\Cache\FlushableInterface;
use SessionHandlerInterface;

/**
 * Class CacheSessionHandler
 * @package Anonym\Components\Session
 */
class CacheSessionHandler implements SessionHandlerInterface
{

    /**
     * the instance of cache driver
     *
     * @var CacheDriverInterface
     */
    protected $cache;

    /**
     * create a new instance and register the cache driver
     *
     * @param CacheDriverInterface $cache
     */
    public function __construct(CacheDriverInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Close the session
     * @link http://php.net/manual/en/sessionhandlerinterface.close.php
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function close()
    {
        return true;
    }

    /**
     * Destroy a session
     * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
     * @param string $session_id The session ID being destroyed.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function destroy($session_id)
    {
        $this->cache->delete($session_id);

        return true;
    }

    /**
     * Cleanup old sessions
     * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
     * @param int $maxlifetime <p>
     * Sessions that have not updated for
     * the last maxlifetime seconds will be removed.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function gc($maxlifetime)
    {
        if ($this->cache instanceof FlushableInterface) {
            $this->cache->flush();
        }

        return true;
    }

    /**
     * Initialize session
     * @link http://php.net/manual/en/sessionhandlerinterface.open.php
     * @param string $save_path The path where to store/retrieve the session.
     * @param string $session_id The session id.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function open($save_path, $session_id)
    {
        return true;
    }

    /**
     * Read session data
     * @link http://php.net/manual/en/sessionhandlerinterface.read.php
     * @param string $session_id The session id to read data for.
     * @return string <p>
     * Returns an encoded string of the read data.
     * If nothing was read, it must return an empty string.
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function read($session_id)
    {
        return $this->cache->get($session_id);
    }

    /**
     * Write session data
     * @link http://php.net/manual/en/sessionhandlerinterface.write.php
     * @param string $session_id The session id.
     * @param string $session_data <p>
     * The encoded session data. This data is the
     * result of the PHP internally encoding
     * the $_SESSION superglobal to a serialized
     * string and passing it as this parameter.
     * Please note sessions use an alternative serialization method.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function write($session_id, $session_data)
    {
        $this->cache->set($session_id, $session_data);

        return true;
    }
}
