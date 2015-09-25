<?php
/**
 *  Bu Sınıf AnonymFramework'de Veritabanı' nı yedeklemede kullanılır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 */

namespace Anonym\Database\Tools\Backup;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Builders\BuildManager;
use Anonym\Components\Database\Mode\Insert;
use Anonym\Components\Filesystem\Filesystem;
use Anonym\Database\Tools\LoadInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class Load
 * @package Anonym\Database\Tools\Backup
 */
class Load extends BuildManager implements LoadInterface
{

    /**
     * Filesystem e ait bir örnek
     *
     * @var Filesystem
     */
    private $file;

    /**
     * @var Base
     */
    private $base;

    /**
     * Sınıfı başlatır ve veritabanı sınıfını sınıfa yerleştirir
     *
     * @param Base|null $base
     */
    public function __construct(Base $base = null)
    {
        parent::__construct($base);
        $this->file = (new Filesystem())->disk('local');
        $this->base = $base;
    }

    /**
     * Girilen dosyayı yürütür
     * @param string $name
     * @return array
     */
    public function get($name = '')
    {
        $return = [];
        if ('' !== $name) {
            $return[$name] = $this->execute($name);
        } else {

            $list = $this->listBackupDir();

            foreach ($list as $file) {
                if ($file instanceof \SplFileInfo) {
                    $name = first(explode('.', $file->getFilename()));
                    $return[$name] = $this->execute($name);
                }
            }
        }
        return $return;
    }


    /**
     * @param string $name
     * @return array
     */
    public function execute($name = '')
    {

        $file = $this->generatePath($name);
        if ($this->file->exists($file)) {
            if (is_readable($file)) {
                $content = $this->file->read($file);
                $content = json_decode($content, true);
                foreach ($content as $arg) {
                    $createTable = $arg['createTable'];
                    $params = $arg['params'];
                    $content = $arg['content'];
                    $table = $arg['table'];
                    // query i çalıştırıyoruz
                    if ($this->firstStepQueryContent($content)) {

                        // tablo yapısını oluşturuyoruz
                        if ($this->againCreateTableQuery($createTable)) {

                            $insert = $this->base->insert($table, function (Insert $mode) use ($params) {
                                return $mode->set($params)->run();
                            });
                            if ($insert) {
                                return true;
                            }

                        }

                    }

                }

            }
        }

        return false;
    }

    /**
     * İlk adımda içeriği yükler
     *
     * @param string $content
     * @return \PDOStatement|bool
     */
    private function firstStepQueryContent($content = '')
    {
        $this->setQuery($content);
        $this->run(true);

        return true;
    }

    /**
     * Klasörün içeriğini döndürür
     *
     * @return Finder
     */
    private function listBackupDir()
    {
        return Finder::create()->files()->name('*.backup')->in(BACKUP);
    }

    /**
     * Tablo yapısını oluşturur
     *
     * @param $createTable
     * @return \PDOStatement|bool
     */
    private function againCreateTableQuery($createTable)
    {
        $this->setQuery($createTable);
        return $this->run(true);
    }


    /**
     * $name 'e girilen isme göre dosyayı siler, eğer boş girilirse dosyayı temizler
     *
     * @param string $name
     * @return array
     */
    public function forget($name = '')
    {
        $return = [];
        if ('' !== $name) {
            $path = $this->generatePath($name);

            if ($this->file->exists($path)) {
                $return[$name] = $this->file->delete($path);
            } else {
                $return[$name] = false;
            }
        } else {
            $list = $this->listBackupDir();

            foreach ($list as $file) {
                if ($file instanceof SplFileInfo) {
                    $return[first(explode('.', $file->getFilename()))] = $this->file->delete($file->getRealPath());
                }
            }

        }

        return $return;

    }

    /**
     * Backup dosyasının yolunu oluşturur
     *
     * @param string $nane
     * @return string
     */
    public function generatePath($nane = '')
    {
        return BACKUP . $nane . '.php';
    }
}
