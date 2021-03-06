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

use Anonym\Console\HandleInterface;
use Anonym\Console\Command;
use Anonym\Facades\Anonym;
/**
 * Class MakeMigrationCommand
 * @package Anonym\Application\Console
 */
class MigrationRunCommand extends Command implements HandleInterface
{
    /**
     *
     * /**
     * @var string
     */
    protected $signature = 'migration:run {name?}';

    /**
     * @var string
     */
    protected $description = "run a migration file, or more.";

    /**
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name') ? $this->argument('name') : '';

        Anonym::call('migration', [
            'function' => 'deploy', 'name' => $name
        ]);

        $this->info(sprintf('%s migration command worked with successfully', $name));
    }
}