<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;
    use Anonym\Components\HttpClient\Request;
    use Anonym\Components\Cookie\Cookie;
    use Anonym\Components\Cookie\CookieInterface;
    use Anonym\Components\Database\Base;
    use Anonym\Components\Session\StrogeInterface;
    use Anonym\Facades\App;

    /**
     * Class Authentication
     * @package Anonym\Components\Security
     */
    class Authentication
    {

        /**
         * Session objesini tutar
         *
         * @var StrogeInterface
         */
        private $session;

        /**
         * Cookie objesini tutar
         *
         * @var CookieInterface
         */
        private $cookie;

        /**
         * Veritabanı objesini tutar
         *
         * @var Base
         */
        private $db;


        /**
         * Tablo ayarlarını tutar
         *
         * @var array
         */
        private $tables;

        const USER_SESSION = 'AnonymFrameworkUser';

        /**
         * Sınıfı başlatır ve session ve cookie objelerini atar
         */
        public function __construct(){
            $this->setSession( App::make('session.stroge'));
            $this->setCookie( new Cookie());
        }

        /**
         * @return Base
         */
        public function getDb()
        {
            return $this->db;
        }

        /**
         * @param Base $db
         * @return Login
         */
        public function setDb(Base $db)
        {
            $this->db = $db;

            return $this;
        }



        /**
         * @return SessionInterface
         */
        public function getSession()
        {
            return $this->session;
        }

        /**
         * @param StrogeInterface $session
         * @return Authentication
         */
        public function setSession(StrogeInterface $session)
        {
            $this->session = $session;

            return $this;
        }

        /**
         * @return CookieInterface
         */
        public function getCookie()
        {
            return $this->cookie;
        }

        /**
         * @param CookieInterface $cookie
         * @return Authentication
         */
        public function setCookie(CookieInterface $cookie)
        {
            $this->cookie = $cookie;

            return $this;
        }

        /**
         * @return array
         */
        public function getTables()
        {
            return $this->tables;
        }

        /**
         * @param array $tables
         * @return Authentication
         */
        public function setTables($tables)
        {
            $this->tables = $tables;

            return $this;
        }


    }
