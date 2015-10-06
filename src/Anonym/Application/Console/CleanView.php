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


class CleanView extends Command implements HandleInterface
{

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'clean the all view files';

    /**
     * the signature of command
     *
     * @var string
     */
    protected $name = 'clean:view';


    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem){
        $this->filesystem = $filesystem;

        parent::__construct();
    }
    /**
     * @return mixed
     */
    public function handle()
    {
        $this->filesystem->cleanDirectory(VIEW);
        $this->info('cleaned all view files');
    }
}
