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

/**
 * Class CacheTableCommand
 * @package Anonym\Application\Console
 */
class CacheClearCommand extends Command implements HandleInterface
{

    /**
     *  the singature of command
     *
     * @var string
     */
    protected $signature = 'cache:clear';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'clear all cache files';

    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    private $file;

    /**
     * create a new instance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->file = $filesystem;

        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $this->file->cleanDirectory(RESOURCE . 'cache');

        $this->info('all cache files removed successfully');
    }

}

