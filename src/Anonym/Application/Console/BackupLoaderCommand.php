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
 * Class BackupLoaderCommand
 * @package Anonym\Application\Console
 */
class BackupLoaderCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'backup:load {name}';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'load database backup file or files';

    /**
     * fire the command
     *
     * @return mixed
     */
    public function handle(){
        $name = $this->argument('name')  ? $this->argument('name') : '';

        $load = BackupLoader::get($name);
        foreach ($load as $key => $return) {
            if (true === $return) {
                $this->info(sprintf('Your %s backup file loaded with successfully', $key));
            }
        }
    }
}
