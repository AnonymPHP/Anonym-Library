<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Security\Authentication;

    use Anonym\Components\Database\Base;
    use Anonym\Components\Database\Mode\Insert;
    use Anonym\Components\Security\Exception\RegisterArgumentsException;

    /**
     * Class Register
     * @package Anonym\Components\Security\Authentication
     */
    class Register extends Authentication implements RegisterInterface
    {

        const USER_FILE = 'user.php';

        /**
         *Sınıfı başlatır
         *
         * @param Base $db
         * @param array $tables
         */
        public function __construct(Base $db, array $tables = [])
        {
            parent::__construct();
            $this->setTables($tables);
            $this->setDb($db);
        }

        /**
         * Kullanıcı kayıt işlemini yapar
         *
         * @param array $post
         * @throws RegisterArgumentsException
         * @return mixed
         */
        public function register(array $post = [])
        {
            $tables = $this->getTables();
            $registerParams = $tables['register'];
            $tableName = $tables['table'];

            if (count($registerParams) === count($post)) {
                $inputValues = array_values($post);
                if (count(array_diff($inputValues, $registerParams)) > 0) {
                    throw new RegisterArgumentsException(sprintf('Register parametreleriniz %s dosyasındakilerle aynı olmalıdır.',self::USER_FILE));
                } else {
                    $db = $this->getDb();
                    $insert = $db->insert($tableName, function (Insert $mode) use ($post) {
                        $mode->set($post)
                            ->run();
                    });

                    return ($insert) ? true : false;
                }
            } else {
                throw new RegisterArgumentsException('Register parametreleriniz %s dosyasındakilerle aynı olmalıdır.', self::USER_FILE);
            }

        }

    }

