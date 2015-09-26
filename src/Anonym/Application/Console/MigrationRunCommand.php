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

use Anonym\Application\Console\HandleInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Anonym\Application\Console\Command;
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        $name = $this->argument('name') ? $this->argument('name') : '';

        Anonym::call('migration', [
            'function' => 'deploy', 'name' => $name
        ]);

        $this->info(sprintf('%s migration command worked with successfully', $name));
    }
}