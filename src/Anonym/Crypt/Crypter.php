<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Crypt;

    /**
     * Class Crypter
     * @package Anonym\Components\Crypt
     */
    class Crypter
    {

        /**
         * @var CrypterEncodeableInterface
         */
        private $crypter;

        /**
         *  Sınııf başlatır ve şifreleyici olarak ön tanımlı olarak atananı kullanır
         *
         *
         */
        public function __construct()
        {
            $this->useDefaultCrypter();
        }

        /**
         * Default olarak AnonymCrypt sınıfı eklenir
         */
        private function useDefaultCrypter()
        {
            $this->setCrypter( new AnonymCrypt());
        }
        /**
         * Veriyi şifreler
         *
         * @param string $encode
         * @return string
         */
        public function encode($encode = ''){
            $crypter = $this->getCrypter();

            if($crypter instanceof CrypterEncodeableInterface){
                return $crypter->encode($encode);
            }else{
                return false;
            }
        }

        /**
         * Şifrelenmiş veriyi çözer
         *
         * @param string $decode
         * @return string
         */
        public function decode($decode = ''){
            $crypter = $this->getCrypter();

            if($crypter instanceof CrypterDecodeableInterface){
                return $crypter->decode($decode);
            }else{
                return false;
            }
        }

        /**
         * @return CrypterEncodeableInterface
         */
        public function getCrypter()
        {
            return $this->crypter;
        }

        /**
         * @param CrypterEncodeableInterface $crypter
         * @return Crypter
         */
        public function setCrypter($crypter)
        {
            $this->crypter = $crypter;

            return $this;
        }
    }
