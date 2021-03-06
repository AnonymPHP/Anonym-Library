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
use Anonym\Support\TemplateGenerator;


/**
 * Class MakeCommand
 * @package Anonym\Application\Console
 */
class MakeCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'make:command {name}';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'Create a new console command with <name>';


    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    protected $file;

    /**
     * create a new isntance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->file = $filesystem;

        parent::__construct();
    }

    /**
     *
     * @return mixed
     */
    public function handle()
    {
        $content = $this->file->get(RESOURCE . 'migrations/command.php.dist');

        $name = $this->argument('name');

        $template = new TemplateGenerator($content);
        $generated = $template->generate([
            'name' => $name
        ]);


        $path = BASE . 'console/Commands/' . $name . '.php';
        $this->file->put($path, $generated);

        $this->info(sprintf('%s command created with successfully in %s', $name, $path));
    }
}
