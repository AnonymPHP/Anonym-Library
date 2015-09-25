<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;

    use ArrayAccess;

    /**
     * Class AuthenticationLoginObject
     * @package Anonym\Components\Security
     */
    class LoginObject implements ArrayAccess
    {

        /**
         * Kullanıcı bilgilerini depolar
         *
         * @var array
         */
        private $information;


        /**
         * Sınıfı başlatır ve kullanıcı bilgilerini ayarlar
         *
         * @param array $information
         */
        public function __construct(array $information = [])
        {
            $this->setInformation($information);
        }

        /**
         * @return array
         */
        public function getInformation()
        {
            return $this->information;
        }

        /**
         * @param array $information
         * @return AuthenticationLoginObject
         */
        public function setInformation($information)
        {
            $this->information = $information;

            return $this;
        }


        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Whether a offset exists
         * @link http://php.net/manual/en/arrayaccess.offsetexists.php
         * @param mixed $offset <p>
         * An offset to check for.
         * </p>
         * @return boolean true on success or false on failure.
         * </p>
         * <p>
         * The return value will be casted to boolean if non-boolean was returned.
         */
        public function offsetExists($offset)
        {
            return isset($this->information[$offset]);
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to retrieve
         * @link http://php.net/manual/en/arrayaccess.offsetget.php
         * @param mixed $offset <p>
         * The offset to retrieve.
         * </p>
         * @return mixed Can return all value types.
         */
        public function offsetGet($offset)
        {
            return $this->information[$offset];
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to set
         * @link http://php.net/manual/en/arrayaccess.offsetset.php
         * @param mixed $offset <p>
         * The offset to assign the value to.
         * </p>
         * @param mixed $value <p>
         * The value to set.
         * </p>
         * @return void
         */
        public function offsetSet($offset, $value)
        {
            $this->information[$offset] = $value;
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to unset
         * @link http://php.net/manual/en/arrayaccess.offsetunset.php
         * @param mixed $offset <p>
         * The offset to unset.
         * </p>
         * @return void
         */
        public function offsetUnset($offset)
        {
            $this->information[$offset] = null;
        }
    }
