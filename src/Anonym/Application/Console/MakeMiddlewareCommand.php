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

use Anonym\Support\TemplateGenerator;
use Anonym\Console\Command;
use Anonym\Filesystem\Filesystem;
use Anonym\Console\HandleInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MakeMiddlewareCommand
 * @package Anonym\Application\Console
 */
class MakeMiddlewareCommand extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'make:middleware {name}';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'create a new middleware with <name>';


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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function handle()
    {
        $content = $this->file->get(RESOURCE . 'migrations/middleware.php.dist');

        $name = $this->argument('name');

        $template = new TemplateGenerator($content);
        $generated = $template->generate([
            'name' => $name
        ]);


        $path = HTTP . 'Middleware/' . $name . '.php';
        $this->file->put($path, $generated);

        $this->info(sprintf('%s middleware created with successfully in %s', $name, $path));
    }
}
