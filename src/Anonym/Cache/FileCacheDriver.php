<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Cache;

use Anonym\Components\Filesystem\Filesystem;
use Anonym\Components\Filesystem\FilesystemAdapter;

/**
 * Class LocalDriver
 * @package Anonym\Components\Caches
 */
class FileCacheDriver extends ConfigRepository implements DriverInterface,
    DriverAdapterInterface,
    FlushableInterface
{

    /**
     *Dosyanın yolunu tutar
     *
     *
     * @var string -> folder
     */
    private $folder;

    /**
     *Dosyanın uzantısını tutar
     *
     *
     * @var string -> ext
     */
    private $ext = '.cache';
    /**
     *
     *
     *
     * @var  FilesystemAdapter-> fileSystem
     */
    private $fileSystem;

    /**
     * Kontrol eder
     *
     * @return bool
     */
    public function check()
    {

        $config = $this->getConfig();

        if (isset($config['ext'])) {
            $this->setExt($config['ext']);
        }

        if (isset($config['folder'])) {

            $folder = $config['folder'];
            $this->setFolder($folder);


            if(!$this->getFileSystem()->exists($folder))
            {
                $this->getFileSystem()->createDir($folder);
                chmod($folder, 0777);
            }
        }else{

            return false;
        }

        // we have do something else

        if (function_exists('gzcompress') && function_exists('gzuncompress')) {
            return true;
        }
    }

    /**
     * Ayarları kullanır ve bazı başlangıç işlemlerini gerçekleştirir
     *
     * @param array $configs
     * @return mixed
     */
    public function boot(array $configs = [])
    {
        $this->setConfig($configs);
        $this->setFileSystem((new Filesystem())->disk('local'));
    }

    /**
     * @return FilesystemAdapter
     */
    public function getFileSystem()
    {
        return $this->fileSystem;
    }

    /**
     * @param FilesystemAdapter $fileSystem
     * @return LocalDriver
     */
    public function setFileSystem(FilesystemAdapter $fileSystem)
    {
        $this->fileSystem = $fileSystem;
        return $this;
    }

    /**
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param string $folder
     * @return LocalDriver
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param string $ext
     * @return LocalDriver
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }



    /**
     * Sınıfta kullanılmak üzere cache dosyalarının yolunu hazırlar
     *
     * @param $path
     * @return string
     */
    private function inPath($path)
    {

        $path =  $this->getFolder() . '/' . $path;
        return $path;
    }

    /**
     * Dosyanın kullanım zamanının geçip geçmediğini kontrol eder
     *
     * @param int $time
     * @return bool
     */
    private function checkTime($time = 0)
    {
        $now = time();

        if ($now > $time) {
            return false;
        }else{
            return true;
        }

    }
    /**
     * Girilen parametreye göre dosyanın yolunu hazırlar
     *
     * @param string $file
     * @return string
     */

    private function cacheFileNameGenaretor($file)
    {
        return $file . $this->getExt();
    }

    /**
     * Dosyaya yazdırılacak içeriği oluşturur
     *
     * @param string $value
     * @param int $time
     * @return string
     */
    private function contentGenerator($value, $time = 0)
    {
        return $time. "#". gzcompress($value);
    }
    /**
     * İçeriği parçalar
     *
     * @param string $content
     * @return array
     */
    private function parseContent($content = '')
    {

        list($time, $content) = explode("#", $content);
        return [
            $time, gzuncompress($content)
        ];

    }
    /**
     * Verinin değerini döndürür
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        $file = $this->cacheFileNameGenaretor($name);
        $file = $this->inPath($file);

        $content = $this->getFileSystem()->read($file);
        $parsed = $this->parseContent($content);

        if (count($parsed) === 2) {
            list($time, $content) = $parsed;

            if ($this->checkTime($time)) {
                return $content;
            }else{
                $this->delete($file);
            }
        }

        return false;
    }

    /**
     * Veri ataması yapar
     *
     * @param string $name
     * @param mixed $value
     * @param int $time
     * @return mixed
     */
    public function set($name, $value, $time = 3600)
    {
        $file = $this->cacheFileNameGenaretor($name);
        $file = $this->inPath($file);

        $time = time() + $time;
        $content = $this->contentGenerator($value, $time);

        if($this->getFileSystem()->exists($file))
        {
           $this->getFileSystem()->delete($file);
        }

        $write = $this->getFileSystem()->put($file, $content);
        if ($write) {

            return true;
        }
        return false;
    }

    /**
     * @param string $name Değer ismi
     * @return bool
     */
    public function delete($name)
    {
        $file = $this->cacheFileNameGenaretor($name);
        $file = $this->inPath($file);

        $filesys = $this->getFileSystem();

        if ($filesys->exists($file)) {
            return $filesys->delete($file);
        }else{
            return false;
        }

    }

    /**
     * Önbelleğe alınan tüm verileri siler
     *
     * @return mixed
     */
    public function flush()
    {

        $files = $this->getFileSystem()->files($this->getFolder());
        foreach($files as $file)
        {
            $this->delete($file);
        }

        return true;
    }

    /**
     * Öyle bir değerin olup olmadığına bakar
     *
     * @param string $name
     * @return mixed
     */
    public function exists($name)
    {
        $file = $this->cacheFileNameGenaretor($name);
        $file = $this->inPath($file);

        if($this->exists($file)){
            return true;
        }else{
            return false;
        }
    }
}
