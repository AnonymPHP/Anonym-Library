<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security;

    /**
     * Class Security
     * @package Anonym\Components\Security
     */
    class Security
    {

        /**
         * Değiştirilecek tagları döndürür
         *
         * @var array
         */
        private $replaceTags = [

        ];

        /**
         *  Sınıfı başlatır
         */
        public function __construct(){

            $this->setReplaceTags([
                '"',
                "'",
                "<",
                ">",
                "&lt;"
                ,"3C"
                ,"3E"
            ]);
        }

        /**
         * xss sorgularından temizler
         *
         * @param string $data
         * @return mixed|string
         * @throws \Exception
         */
        public function xssProtection($data = '')
        {

            $data = str_replace($this->getReplaceTags(), '', $data);
            if (!is_string($data)) {

                throw new \Exception(sprintf('%s veri tipi %s fonksiyonunda kullanılamaz', gettype($data),
                    __FUNCTION__));
            }

            $data = strip_tags(
                htmlspecialchars(
                    htmlentities(
                        filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS))
                )
            );

            return $data;
        }

        /**
         * Epostanın geçerli olup olmadığına bakar
         *
         * @param string $mail
         * @return mixed
         */
        public  function validateEmail($mail = '')
        {

            return filter_var($mail, FILTER_VALIDATE_EMAIL);
        }

        /**
         * return the user ip
         *
         * @return string
         */
        public  static function ip()
        {
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode(',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }

            return $ip;
        }


        /**
         * Url i kontrol eder
         *
         * @param string $url
         * @return mixed
         */
        public  function validateUrl($url = '')
        {

            return filter_var($url, FILTER_VALIDATE_URL);
        }

        /**
         * @return array
         */
        public function getReplaceTags()
        {
            return $this->replaceTags;
        }

        /**
         * @param array $replaceTags
         * @return Security
         */
        public function setReplaceTags($replaceTags)
        {
            $this->replaceTags = $replaceTags;

            return $this;
        }
    }
