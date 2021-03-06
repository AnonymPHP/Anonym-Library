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
use Anonym\Facades\Migration;
use Anonym\Filesystem\Filesystem;
/**
 * Class CacheTableCommand
 * @package Anonym\Application\Console
 */
class CacheTableCommand extends Command implements HandleInterface
{

    /**
     *  the singature of command
     *
     * @var string
     */
    protected $signature = 'cache:table';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'create migration file for caches';

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
        $content = file_get_contents(RESOURCE . '/migrations/stubs/cache_table.php.dist');

        Anonym::call('make:migration', [
            'name' => 'Cache'
         ]);

        $path = Migration::createName('Cache');
        $this->file->put($path, $content);

        $this->info('Cache Migration created successfully');
    }
}
