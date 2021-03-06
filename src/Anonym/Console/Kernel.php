<?php
/**
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @copyright AnonymMedya, 2015
 */

namespace Anonym\Console;


use Symfony\Component\Console\Application as SymfonyConsole;
use Anonym\Application\Console\MigrationForgetCommand;
use Anonym\Application\Console\LoginLogsClearCommand;
use Anonym\Application\Console\MakeMiddlewareCommand;
use Anonym\Application\Console\MakeMigrationCommand;
use Anonym\Application\Console\ClearCompiledCommand;
use Anonym\Application\Console\DeploySeedAllCommand;
use Symfony\Component\Console\Output\BufferedOutput;
use Anonym\Application\Console\MigrationAllCommand;
use Anonym\Application\Console\BackupLoaderCommand;
use Anonym\Application\Console\BackupForgetCommand;
use Anonym\Application\Console\MigrationRunCommand;
use Anonym\Console\Schedule\ScheduleCleanCommands;
use Anonym\Application\Console\ConfigCacheCommand;
use Anonym\Application\Console\MakeBackupCommand;
use Anonym\Application\Console\DeploySeedCommand;
use Anonym\Application\Console\CacheTableCommand;
use Anonym\Application\Console\CacheClearCommand;
use Anonym\Application\Console\MakeModelCommand;
use Symfony\Component\Console\Input\InputOption;
use Anonym\Console\Schedule\ScheduleRunCommands;
use Symfony\Component\Console\Input\ArrayInput;
use Anonym\Application\Console\MakeSeedCommand;
use Anonym\Application\Console\OptimizeCommand;
use Anonym\Application\Console\MakeController;
use Illuminate\Contracts\Container\Container;
use Anonym\Application\Console\MakeListener;
use Anonym\Application\Console\Installation;
use Anonym\Application\Console\MakeCommand;
use Anonym\Application\Console\MakeBlade;
use Anonym\Application\Console\Migration;
use Anonym\Application\Console\MakeEvent;
use Anonym\Application\Console\MakeView;
use Anonym\Application\Console\Backup;
use Anonym\Cron\EventReposity;
use Anonym\Cron\Cron;

/**
 * Class Console
 * @package Anonym\Application\Console
 */
class Kernel extends SymfonyConsole
{

    /**
     * @var BufferedOutput
     */
    private $lastOutput;


    /**
     * the instance of cron
     *
     * @var Cron
     */
    protected static $schedule;

    /**
     * an array for commands
     *
     * @var array
     */
    protected $commands = [];


    /**
     * the instance of anonmy application
     *
     * @var \Anonym\Application\Application
     */
    protected $container;

    /**
     * an array for default commands
     *
     * @var array
     */
    protected $kernel = [
        MigrationForgetCommand::class,
        ScheduleCleanCommands::class,
        LoginLogsClearCommand::class,
        MakeMiddlewareCommand::class,
        MakeMigrationCommand::class,
        ClearCompiledCommand::class,
        DeploySeedAllCommand::class,
        MigrationAllCommand::class,
        ScheduleRunCommands::class,
        BackupLoaderCommand::class,
        BackupForgetCommand::class,
        MigrationRunCommand::class,
        ConfigCacheCommand::class,
        MakeBackupCommand::class,
        DeploySeedCommand::class,
        CacheTableCommand::class,
        CacheClearCommand::class,
        MakeModelCommand::class,
        MakeSeedCommand::class,
        OptimizeCommand::class,
        MakeController::class,
        MakeListener::class,
        Installation::class,
        MakeCommand::class,
        MakeBlade::class,
        Migration::class,
        MakeEvent::class,
        MakeView::class,
        Backup::class
    ];

    /**
     * Sınıfı başlatır ve bazı atamaları gerçekleştirir
     * @param Application $application
     * @param int $version
     */
    public function __construct(Application $container, $version = 1)
    {

        $this->setContainer($container);
        $this->runParentClass($version);
        static::$schedule = $schedule = new Cron();

        $this->resolveCommands();
        $this->schedule($schedule);
        static::$schedule->setCache(EventReposity::getEvents());


    }

    /**
     * execute parent class
     *
     * @param int $version
     */
    private function runParentClass($version)
    {
        $this->setAutoExit(false);
        $this->setCatchExceptions(true);

        // now we will register applicatio name and version,
        // application name by default is Anonym.
        parent::__construct('Anonym', $version);
    }

    /**
     * resolve the commands
     *
     */
    protected function resolveCommands()
    {
        $this->commands = $commands = array_merge($this->kernel, $this->commands);

        foreach ($commands as $command) {

            $command = $this->getContainer()->make($command)->setContainer($this->getContainer());
            $this->addToParent($command);
        }
    }


    /**
     * Komutu yürütür
     * @param $command
     * @param array $params
     * @return int
     * @throws \Exception
     */
    public function call($command, array $params = [])
    {
        $params['command'] = $command;
        $this->lastOutput = new BufferedOutput();

        return $this->find($command)->run(new ArrayInput($params), $this->lastOutput);
    }

    /**
     * Girilen Komutu sınıfa ekler
     * @param Command $command
     */
    public function addToParent(Command $command)
    {
        $this->add($command);
    }

    /**
     * Çıktıyı döndürür
     * @return string
     */
    public function output()
    {
        return isset($this->lastOutput) ? $this->lastOutput->fetch() : '';
    }

    /**
     * Get the default input definitions for the Anonyms.
     *
     * This is used to add the --env option to every available command.
     *
     * @return \Symfony\Component\Console\Input\InputDefinition
     */
    protected function getDefaultInputDefinition()
    {
        $definition = parent::getDefaultInputDefinition();
        $definition->addOption($this->getEnvironmentOption());

        return $definition;
    }

    /**
     * Get the global environment option for the definition.
     *
     * @return \Symfony\Component\Console\Input\InputOption
     */
    protected function getEnvironmentOption()
    {
        $message = 'The environment the command should run under.';

        return new InputOption('--env', null, InputOption::VALUE_OPTIONAL, $message);
    }


    /**
     * @return BufferedOutput
     */
    public function getLastOutput()
    {
        return $this->lastOutput;
    }

    /**
     * @param BufferedOutput $lastOutput
     * @return Kernel
     */
    public function setLastOutput($lastOutput)
    {
        $this->lastOutput = $lastOutput;
        return $this;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param array $commands
     * @return Kernel
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;
        return $this;
    }

    /**
     * @return Application
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Application $container
     * @return Kernel
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return array
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * @param array $kernel
     * @return Kernel
     */
    public function setKernel($kernel)
    {
        $this->kernel = $kernel;
        return $this;
    }
}
