<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security;
    use Anonym\Http\ServerHttpHeaders;
    use Anonym\Http\Response;

    /**
     * Class AccessSecurity
     * @package Anonym\Security
     */
    class AccessSecurity extends ServerHttpHeaders
    {
        /**
         * Ayarları tutar
         *
         * @var array
         */
        private $configs;
        /**
         * Başlıkları Tutar
         *
         * @var array
         */
        private $httpConfigs;
        /**
         * Parametrelerin karşılıkları.
         */
        private $message = 'Bu Sayfaya Giriş Yetkiniz Bulunmamaktadır.';
        /**
         * Kullanılacak paremetreleri ve onların başlıklardaki karşılıklarını depolar.
         *
         * @var array
         */
        private $params = [
            'allowedUserAgent'  => 'User-Agent',
            'allowedEncoding'   => 'Accept-Encoding',
            'allowedLanguage'   => 'Accept-Language',
            'allowedAccept'     => 'Accept',
            'allowedConnection' => 'Connection',
            'allowedReferer'    => 'Referer',
            'allowedMethod'     => 'Method'
        ];
        /**
         * Ayarları alır ve başlıkları tutar
         *
         * @param array $config
         */
        public function __construct(array $config = [])
        {
            parent::__construct();
            $this->setConfig($config);
            $this->httpConfigs = $this->getHeaders();
        }
        /**
         * Ayarları ayarlar
         *
         * @param array $config
         * @return $this
         */
        public function setConfig(array $config = [])
        {
            $this->configs = $config;
            return $this;
        }

        /**
         * Kontrolleri Yapar ve Kullanıcının siteye girip giremeyeceğiniz Söyler.
         */
        public function run()
        {
            $configs = $this->configs;
            $params = $this->params;
            foreach ($configs as $name => $value) {
                if ($value === '*') {
                    continue;
                }
                if (isset($params[$name])) {
                    $param = $params[$name];
                    if (is_array($value)) {
                        $check = $this->arrayValueChecker($param, $value);
                    } elseif (is_string($value)) {
                        $check = $this->stringValueChecker($param, $value);
                    }
                    if (false === $check) {
                        break;
                    }
                } else {
                    continue;
                }
            }
            if (false === $check) {
                $this->stopPageProcess();
            }
        }

        /**
         * Sayfanın Yürütmesini durdurur.
         */
        private function stopPageProcess()
        {
            Response::make($this->getMessage(), 401)->send();
        }
        /**
         * array veriyi parçalar
         *
         * @param $paramName
         * @param $value
         * @return bool
         */
        private function arrayValueChecker($paramName, $value)
        {
            if (isset($this->httpConfigs[$paramName])) {
                foreach ($value as $val) {
                    if (true === $this->stringValueChecker($paramName, $val)) {
                        return true;
                    }
                }
            } else {
                return false;
            }
        }

        /**
         * String veride değeri arar
         *
         * @param $paramName
         * @param $value
         * @return bool
         */
        private function stringValueChecker($paramName, $value)
        {
            if (isset($this->httpConfigs[$paramName])) {
                $param = $this->httpConfigs[$paramName];
                if (strstr($param, $value) && false !== strpos($param, $value)) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }

        /**
         * Hata kısmında verilecek mesajın atamasını yapar
         *
         * @param string $message
         * @return $this
         */
        public function setMessage($message = '')
        {
            $this->message = $message;
            return $this;
        }
        /**
         * Mesajın Geri Dönüiünü yapar.
         *
         * @return string
         */
        public function getMessage()
        {
            return $this->message;
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
         * @return AccessSecurity
         */
        public function setConfigs($configs)
        {
            $this->configs = $configs;

            return $this;
        }

        /**
         * @return array
         */
        public function getHttpConfigs()
        {
            return $this->httpConfigs;
        }

        /**
         * @param array $httpConfigs
         * @return AccessSecurity
         */
        public function setHttpConfigs($httpConfigs)
        {
            $this->httpConfigs = $httpConfigs;

            return $this;
        }

        /**
         * @return array
         */
        public function getParams()
        {
            return $this->params;
        }

        /**
         * @param array $params
         * @return AccessSecurity
         */
        public function setParams($params)
        {
            $this->params = $params;

            return $this;
        }
    }
