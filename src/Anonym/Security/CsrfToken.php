<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Security;
    use Anonym\Facades\Session;
    use Anonym\Security\Exception\VariableNotFoundException;
    use Anonym\Security\Exception\CsrfTokenMatchException;
    use Anonym\Security\CsrfTokenInterface;
    use Anonym\Http\Input;
    /**
     * Class CsrfToken
     * @package Anonym\Security
     */
    class CsrfToken implements CsrfTokenInterface
    {
        /**
         * Form gönderisinde aranacak değer
         *
         * @var string
         */
        private $formFieldName = '_token';

        /**
         * @var KeyGeneratorInterface
         */
        private $securityKeyGenerate;


        /**
         * sınıfı başlatır
         */
        public function __construct()
        {
            $this->useDefaultValues();
            Session::set('tokenName', $this->getFormFieldName());
        }

        /**
         * Yürütme işlemini yapar
         *
         * @return bool
         * @throws CsrfTokenMatchException
         */
        public function run()
        {
            if (Session::has('tokenName')) {
                $this->check();
            } else {
                return false;
            }
        }

        /**
         * Son kontrolleri yapar
         */
        private function check(){
            if (Input::has($this->getFormFieldName())) {
                $key = Input::get($this->getFormFieldName());
                if ($key === Session::get($this->getFormFieldName())) {
                    return true;
                } else {
                    throw new CsrfTokenMatchException(sprintf('Girdiğiniz %s token olması gereken tokenle eşleşmiyor',
                        $key));
                }
            } else {
                throw new CsrfTokenMatchException(sprintf('Herhangi bir Token Girişi yapmamışsınız'));
            }

        }
        /**
         *  default olarak değerleri atar
         */
        private function useDefaultValues(){
            $this->setSecurityKeyGenerate( new SecurityKeyGenerator());
        }

        /**
         * Anahtar oluşturucuyu getirir.
         *
         * @return KeyGeneratorInterface
         */
        public function getSecurityKeyGenerate()
        {
            return $this->securityKeyGenerate;
        }

        /**
         * @param KeyGeneratorInterface $securityKeyGenerate
         * @return CsrfToken
         */
        public function setSecurityKeyGenerate(KeyGeneratorInterface $securityKeyGenerate)
        {
            $this->securityKeyGenerate = $securityKeyGenerate;

            return $this;
        }

        /**
         * @return string
         */
        public function getFormFieldName()
        {
            return $this->formFieldName;
        }

        /**
         * @param string $formFieldName
         * @return CsrfToken
         */
        public function setFormFieldName($formFieldName)
        {
            $this->formFieldName = $formFieldName;

            return $this;
        }

        /**
         * @return string
         */
        public function getToken()
        {
            return $this->getSecurityKeyGenerate()->generate();
        }

        /**
         * @param string $name
         * @throws VariableNotFoundException
         * @return string
         */
        public function __get($name)
        {
            if('token' === $name)
            {
                return $this->getToken();
            }else{
                throw new VariableNotFoundException(sprintf('%s adında bir değer bulunamadı', $name));
            }
        }

    }
