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
use Anonym\Console\HandleInterface;

/**
 * Class MakeBackupCommand
 * @package Anonym\Application\Console
 */
class BackupForgetCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'forget:backup {name?}';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'remove single or multipile backup files';

    /**
     * fire the command
     *
     * @return mixed
     */
    public function handle(){
        $name = $this->argument('name') ? $this->argument('name') : false;
        if (false === $name) {
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
}
