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
 * Class MakeSeedCommand
 * @package Anonym\Application\Console
 */
class MakeSeedCommand extends Command implements HandleInterface
{

    /**
     * the name of signature
     *
     * @var string
     */
    protected $signature = 'make:seed {name}';

    /**
     * @var string
     */
    protected $description = "create a new seed file";

    /**
     * @var Filesystem
     */
    protected $file;

    /**
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
        $template = new TemplateGenerator($this->file->get(RESOURCE.'migrations/seed.php.dist'));
        $name = $this->argument('name');
        $content = $template->generate([
            'name' => $name
        ]);
        $path = DATABASE."seeds/$name.php";
        if (!$this->file->exists($path)) {
            $this->file->create($path);
            $this->file->put($path, $content);
        }
        $this->info(sprintf('%s seed created successfully', $name));
    }
}