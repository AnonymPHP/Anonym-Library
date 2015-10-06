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

/**
 * Class MakeBlade
 * @package Anonym\Application\Console
 */
class MakeBlade extends Command implements HandleInterface
{
    /**
     *
    /**
     * @var string
     */
    protected $signature = 'make:blade {name}';

    /**
     * @var string
     */
    protected $description = "create a new blade view file";


    /**
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name').'.blade';

        Anonym::call('make:view', [
            'name' => $name
        ]);

        $this->info(sprintf('%s blade view created with successfully', $name));
    }
}
