<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Database\Capsule;

use Anonym\Components\Database\Base;
use ArrayAccess;
/**
 * Class Capsule
 * @package Anonym\Components\Database\Capsule
 */
class Capsule implements ArrayAccess
{

    /**
     * the story of connections
     *
     * @var array
     */
    private $connections;

    /**
     * create a new instance and add the connection
     *
     * @param Base $connection
     * @param string $name
     */
    public function __construct(Base $connection = null, $name = '')
    {
        $this->addConnection($connection, $name);
    }

    /**
     * add a connection to capsule
     *
     * @param Base $connection
     * @param string $name
     * @throws CapsuleInstanceException
     */
    public function addConnection(Base $connection = null, $name = '')
    {
        if($connection instanceof Base)
        {
            if($name !== '')
            {
                $this->connections[$name] = $connection;
            }else{
                $this->connections[] = $connection;
            }
        }else{
            throw new CapsuleInstanceException(sprintf('Connection variable must be a instance of %s', Base::class));
        }
    }


    /**
     * delete a connection in capsule
     *
     * @param mixed $offset
     * @return $this
     */
    public function deleteConnection($offset)
    {
        if(isset($this->connections[$offset]))
        {
            unset($this->connections[$offset]);
        }

        return $this;
    }


    /**
     * return all registered database connection
     *
     * @return array
     */
    public function getConnections(){
        return $this->connections;
    }


    /**
     * determine there is a $name database
     *
     * @param string $name
     * @return bool
     */
    public function isConnection($name = ''){
        return isset($this->connections[$name]);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->connections[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->connections[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
         $this->connections[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
         $this->deleteConnection($offset);
    }
}
