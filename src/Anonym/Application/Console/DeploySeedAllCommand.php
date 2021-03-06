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
class DeploySeedAllCommand extends Command implements HandleInterface
{

    /**
     * the name of signature
     *
     * @var string
     */
    protected $signature = 'seed:all';

    /**
     * @var string
     */
    protected $description = "run all seed files";

    /**
     *
     * @return mixed
     */
    public function handle()
    {

        $seeder = new Seeder($this->getContainer());
        $seeder->setCommand($this);

        foreach($this->readAllSeeds() as $name){
            $seeder->call($name);
        }
    }

    /**
     *
     * read all seeds name
     */
    public function readAllSeeds()
    {
        $list = Finder::create()->files()->name('*.php')->in(DATABASE. 'seeds/');

        $result = [];
        foreach ($list as $l) {
            $exp = first(explode('.', $l->getFilename()));
            $result[] = $exp;
        }

        return $result;
    }
}
