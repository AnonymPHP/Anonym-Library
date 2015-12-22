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
class MigrationAllCommand extends Command implements HandleInterface
{

    /**
     * the name of signature
     *
     * @var string
     */
    protected $signature = 'migration:all';

    /**
     * @var string
     */
    protected $description = "run all migration files";

    /**
     *
     * @return mixed
     */
    public function handle()
    {


        foreach($this->readAllSeeds() as $name){

        }
    }

    /**
     *
     * read all seeds name
     */
    public function readAllSeeds()
    {
        $list = Finder::create()->files()->name('*.php')->in(DATABASE. 'migrations/');

        $result = [];
        foreach ($list as $l) {
            $exp = first(explode('.', $l->getFilename()));
            $result[] = $exp;
        }

        return $result;
    }
}
