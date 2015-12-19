<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Tools;

use Anonym\Database\Base;
use Anonym\Database\Database;
use Exception;
use Symfony\Component\Finder\Finder;

/**
 * Class MigrationManager
 * @package Anonym\Tools
 */
class MigrationManager
{

    /**
     * @var Database
     */
    private $base;

    /**
     * Dosya ismini oluşturur
     *
     * @param string $name
     * @return string
     */
    public function createName($name = '')
    {
        return MIGRATION . $name . '.php';
    }

    /**
     *
     * Uygulamayı alır ve toplamaya başlar
     *
     * @param Database $base
     */
    public function __construct(Database $base)
    {
        $this->base = $base;
        Schema::setConnection($this->base->getBase()->getConnection());
    }

    /**
     * Migration sınıfını yürütür
     * @param string $fileName
     * @return array
     */
    public function run($fileName)
    {

        $return = [];
        if ('' !== $fileName) {
            $return = [$this->execute($fileName)];
        } else {

            $list = Finder::create()->files()->name('*.php')->in(MIGRATION);

            foreach ($list as $l) {
                $return[] = $this->execute(first(explode('.', $l->getFilename())));
            }
        }

        return $return;
    }

    /**
     * İşlemi gerçekleştirir
     *
     * @param string $name
     * @throws Exception
     * @return bool
     */
    public function execute($name = '')
    {

        $migration = MIGRATION_NAMESPACE . $name;
        $migration = new $migration;

        $return = [
            'up' => null,
            'down' => null,
            'name' => $name
        ];

        if ($migration instanceof MigrationInterface) {
            $return['down'] = $migration->down();
            $return['up'] = $migration->up();

            return $return;
        } else {
            throw new Exception('migration sınıfınız MigrationInterface e sahip değil');
        }

    }
}
