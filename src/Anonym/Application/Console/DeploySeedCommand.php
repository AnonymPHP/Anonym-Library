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
use Anonym\Tools\Seeder;
use Symfony\Component\Finder\Finder;

/**
 * Class DeploySeedCommand
 * @package Anonym\Application\Console
 */
class DeploySeedCommand extends Command implements HandleInterface
{

    /**
     * the name of signature
     *
     * @var string
     */
    protected $signature = 'seed:run { name? }';

    /**
     * @var string
     */
    protected $description = "run a seed file";

    /**
     * @return mixed
     */
    public function handle()
    {
        $argument = $this->argument('name') ? $this->argument('name') : '';
        $seeder = new Seeder($this->getContainer());
        $seeder->setCommand($this);

        $seeder->call($argument);
    }

    /**
     *
     * read all seeds name
     */
    public function readAllSeeds()
    {
        $list = Finder::create()->files()->name('*.php')->in(MIGRATION);

        $result = [];
        foreach ($list as $l) {
            $exp = first(explode('.', $l->getFilename()));
            $result[] = end(explode('/', $exp));
        }

        return $result;
    }
}
