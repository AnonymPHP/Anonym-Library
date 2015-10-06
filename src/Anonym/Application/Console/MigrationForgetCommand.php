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
use Anonym\Facades\Anonym;
use Anonym\Filesystem\Filesystem;

/**
 * Class MigrationForgetCommand
 * @package Anonym\Application\Console
 */
class MigrationForgetCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'migration:forget { name? }';

    /**
     * the description on command
     *
     * @var string
     */
    protected $description = 'remove an migration file';

    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    private $file;

    /**
     * create a new instance and register filesystem instance
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem){
        $this->file = $filesystem;

        parent::__construct();
    }
    /**
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name') ? $this->argument('name') : '';

        if('' !== $name){
            Anonym::call('migration', [
                'function' => 'forget', 'name' => $name
            ]);

            $this->info(sprintf('%s migration file removed successfully', $name));
        }else{
            if($this->confirm('We will clean your migration directory, Do you want do this? [y|N]')){
                $this->file->cleanDirectory(MIGRATION);

                $this->info('Your all migration files removed successfully');
            }
        }
    }
}
