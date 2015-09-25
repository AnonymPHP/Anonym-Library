<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

       namespace Anonym\Components\Security\Firewall\Firewall;

    use Anonym\Components\Security\Exception\FirewallException;
    use Anonym\Components\Security\Firewall\UserAgentFirewall;
    use Anonym\Components\Security\Firewall\EncodingFirewall;
    use Anonym\Components\Security\Firewall\LanguageFirewall;
    use Anonym\Components\Security\Firewall\AcceptFirewall;
    use Anonym\Components\Security\Firewall\ConnectionFirewall;
    use Anonym\Components\Security\Firewall\RefererFirewall;
    use Anonym\Components\Security\Firewall\MethodFirewall;
    use Anonym\Components\Security\Firewall\CheckerSetterInterface;
    use Anonym\Components\HttpClient\ServerHttpHeaders;
    use Anonym\Components\Security\Exception\ClassInstanceException;
    use Anonym\Components\Security\Firewall\FirewallCheckerInterface;

    /**
     * Class Firewall
     * @package Anonym\Components\Security
     */
    class Firewall extends ServerHttpHeaders
    {

        /**
         * Parametreler ve server değişkenindeki değerleri tutulur
         *
         * @var array
         */
        private $parameters = [
            'allowedUserAgent' => 'User-Agent',
            'allowedEncoding' => 'Accept-Encoding',
            'allowedLanguage' => 'Accept-Language',
            'allowedAccept' => 'Accept',
            'allowedConnection' => 'Connection',
            'allowedReferer' => 'Referer',
            'allowedMethod' => 'Method',
        ];

        /**
         * Parametreleri ve onları kontrol edecek sınıfların adı tutulur
         *
         * @var array
         */
        private $classes = [
            'allowedUserAgent' => UserAgentFirewall::class,
            'allowedEncoding' => EncodingFirewall::class,
            'allowedLanguage' => LanguageFirewall::class,
            'allowedAccept' => AcceptFirewall::class,
            'allowedConnection' => ConnectionFirewall::class,
            'allowedReferer' => RefererFirewall::class,
            'allowedMethod' => MethodFirewall::class,
        ];


        /**
         * Kullanıcı tarafından kullanılmasına izin verilen parametreler
         *
         * @var array
         */
        private $allowed;

        /**
         * Sınıfı başlatır
         *
         * @param array $allowed
         */
        public function __construct(array $allowed = [])
        {
            parent::__construct();
            $this->setAllowed($allowed);
        }

        /**
         *
         *  işlemi yürütür
         */
        public function run()
        {
            $headers = $this->getHeaders();
            $classes = $this->getClasses();

            foreach ($this->getParameters() as $key => $parameter) {

                $value = isset($headers[$parameter]) ? $headers[$parameter] : '';
                $class = isset($classes[$key]) ? $classes[$key] : false;

                if (is_string($class)) {
                    $class = new $class();

                    if ($class instanceof CheckerSetterInterface ||
                        $class instanceof FirewallCheckerInterface
                    ) {
                        $allowed = $this->getAllowed()[$key];
                        $class->setAlloweds($allowed);
                        $class->setValue($value);

                    } else {
                        throw new ClassInstanceException(
                            sprintf('Sınıfınız %s interface ine sahip olmalıdır', CheckerSetterInterface::class)
                        );
                    }
                } elseif ($class instanceof FirewallCheckerInterface) {
                    $class->setAlloweds($this->getAllowed());
                    $class->setValue($value);
                } else {
                    throw new ClassInstanceException('Girdiğiniz içerik geçerli bir checker değil');
                }

                $handle = $class->handle();

                if (false === $handle) {
                    throw new FirewallException('Sahip Olduğunuz bazı özelliklerden dolayı uygulamamıza erişemezsiniz');
                }
            }
        }


        /**
         * Değerleri sınıfa ekler
         *
         * @param array $values
         * @return $this
         */
        public function addFirewall(array $values = [])
        {
            $parametres = $values['parametres'];

            $this->parameters[] = $parametres;
            $this->classes= $values['classes'];
            return $this;
        }

        /**
         * @return array
         */
        public function getAllowed()
        {
            return $this->allowed;
        }


        /**
         * @param array $allowed
         */
        public function setAllowed(array $allowed)
        {
            $this->allowed = $allowed;
        }

        /**
         * @return array
         */
        public function getParameters()
        {
            return $this->parameters;
        }

        /**
         * @param array $parameters
         * @return Firewall
         */
        public function setParameters(array $parameters)
        {
            $this->parameters = $parameters;

            return $this;
        }

        /**
         * @return array
         */
        public function getClasses()
        {
            return $this->classes;
        }

        /**
         * @param array $classes
         * @return Firewall
         */
        public function setClasses(array $classes)
        {
            $this->classes = $classes;

            return $this;
        }


    }
