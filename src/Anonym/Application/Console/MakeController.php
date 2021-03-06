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
 * Class MakeController
 * @package Anonym\Application\Console
 */
class MakeController extends Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'make:controller {name}';


    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'create a new controller file';

    /**
     * the instance of filesystem
     *
     * @var Filesystem
     */
    private $filesystem;

    /**
     * create an event instance and register filesystem
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        parent::__construct();
    }

    /**
     * execute the command
     *
     * @return mixed
     */
    public function handle()
    {
        $content = file_get_contents(RESOURCE.'migrations/controller.php.dist');

        $generator = new TemplateGenerator($content);
        $name = $this->argument('name');

        $path = HTTP.'Controllers/'.$name.'.php';
        $generated = $generator->generate(['name' => $name]);
        if (!$this->filesystem->exists($path)) {
           $this->filesystem->create($path);
            $this->filesystem->put($path, $generated);
            $this->info(sprintf('%s created succesfully to %s', $name, $path));
        } else {
            $this->error(sprintf('%s Controller already exists', $name));
        }
    }
}
