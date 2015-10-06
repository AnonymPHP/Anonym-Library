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
use Anonym\Filesystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class MakeView
 * @package Anonym\Application\Console
 */
class MakeView extends Command implements HandleInterface
{


    /**
     *
    /**
     * @var string
     */
    protected $signature = 'make:view {name}';

    /**
     * @var string
     */
    protected $description = "create a new view file";

    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct(Filesystem $filesystem){
        $this->filesystem = $filesystem;
        parent::__construct();
    }
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $path = $this->getContainer()->getViewPath().$name.'.php';

        if (!$this->filesystem->exists($path)) {
            $this->filesystem->create($path);
        }

        $this->info(sprintf('%s wiew file is created with succesfully', $name));
    }
}
