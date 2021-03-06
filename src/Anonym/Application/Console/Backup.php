<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Application\Console;


use Anonym\Console\Command;
use Anonym\Console\HandleInterface;
use Anonym\Facades\BackupLoader;
use Anonym\Facades\Backup as BackupFacade;

/**
 * Class Backup
 * @package Anonym\Application\Console
 */
class Backup extends Command implements HandleInterface
{

    /**
     * Komut İmzası
     *
     * @var string
     */
    protected $signature = 'backup { function? } { params? } { tables? }';
    /**
     * Komut açıklaması
     *
     * @var string
     */
    protected $description = 'Veritabanında yedekleme ve yükleme işlemleri için kullanılır';
    /**
     * Komut adı
     *
     * @var
     */
    protected $name;


    /**
     * Komutun yakalndığı zaman tetikleneceği fonksiyon
     *
     * @return mixed
     */
    public function handle()
    {

        $command = $this->argument('function') ? $this->argument('function') : 'create';
        $param = $this->argument('params') ? $this->argument('params') : '';
        if (is_callable([$this, $command])) {
            $this->$command($param);
        } else {
            $this->error(sprintf('%s command not found', $command));
        }
    }
    /**
     * Yedeklenen backup dosyasını siler
     *
     * @param string $name
     */
    public function forget($name = '')
    {
        if ('' === $name) {
            $confirm = 'Your all backup files will be remove, do you accept?[yes|no]';
        } else {
            $confirm = sprintf('Your %s backup file will be remove, do you accept?[yes|no]', $name);
        }
        if ($this->confirm($confirm, true)) {
            $return = BackupLoader::forget($name);
            foreach ($return as $key => $response) {
                if (true === $response) {
                    $this->info(sprintf('%s backup successfully removed', $key));
                } else {
                    $this->error(sprintf('something went wrong while your %s backup file remove', $key));
                }
            }
        }
    }
    /**
     * Yeni bir veritabanı yedeği oluşturur
     *
     * @param string $name
     */
    public function create($name = '')
    {
        $tables = $this->argument('tables') ? $this->argument('tables') : '*';
        $return = BackupFacade::backup($tables, $name);
        if (true === $return) {
            $this->info(sprintf('%s backup file generated in %s path', $name,
                BackupLoader::generatePath($name)));
        } else {
            $this->error(sprintf('%s cant create, file already exists', $name));
        }
    }
    /**
     * yedekleri yükler
     *
     * @param string $name
     */
    public function load($name = '')
    {
        $load = BackupLoader::get($name);
        foreach ($load as $key => $return) {
            if (true === $return) {
                $this->info(sprintf('Your %s backup file loaded with successfully', $key));
            }
        }
    }
}