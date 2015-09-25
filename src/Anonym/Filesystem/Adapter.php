<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FilesystemInterface;

class Adapter
{

    /**
     * the instance of filesystem adapter
     *
     * @var FilesystemInterface
     */
    private $adapter;

    /**
     * create a new instance and set the adapter
     *
     * @param FilesystemInterface $adapter
     */
    public function __construct(FilesystemInterface $adapter)
    {
        $this->adapter = $adapter;

    }

    /**
     * set the chmod to the file
     *
     * @param string $path
     * @param int $mod
     * @return bool
     */
    public function chmod($path, $mod = 0777)
    {
        if ($this->adapter instanceof Local) {
            return chmod($path, $mod);
        }

        return false;
    }

    /**
     * check the file is readable
     *
     * @param string $path
     * @return bool
     */
    public function isReadable($path)
    {
        return $this->adapter instanceof Local ? is_readable($path) : false;
    }

    /**
     * check the file is writeable
     *
     * @param string $path
     * @return bool
     */
    public function isWriteable($path)
    {
        return $this->adapter instanceof Local ? is_writeable($path) : false;
    }

    /**
     * create a new file with file path
     *
     * @param string $path
     * @return bool
     */
    public function create($path = '')
    {
        if ($this->adapter instanceof Local) {
            return touch($path);
        }

        return false;
    }


    /**
     * check the file
     *
     * @param string $path
     * @return bool
     */
    public function exists($path = '')
    {
        return $this->adapter->has($path);
    }
    /**
     * call the method from adapter
     *
     * @param string $name the name of method
     * @param array $args  the parameters will be send to method
     * @return mixed
     */
    public function __call($name, $args = [])
    {
        return call_user_func_array([$this->adapter, $name], $args);
    }
}
