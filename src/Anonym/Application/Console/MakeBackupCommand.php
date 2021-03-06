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
use Anonym\Facades\BackupLoader;
use Anonym\Console\Command;
use Anonym\Facades\Backup as BackupFacade;
use Anonym\Console\HandleInterface;

/**
 * Class MakeBackupCommand
 * @package Anonym\Application\Console
 */
class MakeBackupCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'make:backup {name} {tables?}';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'create a new database backup file';

    /**
     * fire the command
     *
     * @return mixed
     */
    public function handle(){
        $name = $this->argument('name');
        $tables = $this->argument('tables') ? $this->argument('tables') : '*';
        $return = BackupFacade::backup($tables, $name);
        if (true === $return) {
            $this->info(sprintf('%s backup file generated in %s path', $name,
                BackupLoader::generatePath($name)));
        } else {
            $this->error(sprintf('%s cant create, file already exists', $name));
        }
    }
}
