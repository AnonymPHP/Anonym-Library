<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Tools;

use Illuminate\Container\Container;
use Anonym\Components\Console\Command;
/**
 * Class Seeder
 * @package Anonym\Database\Tools\Backup
 */
class Seeder implements SeedInterface
{

    /**
     * @var string
     */
    protected $container;

    /**
     * @var Command
     */
    protected $command;
    /**
     * create a new instance
     *
     * @param Container|null $container
     */
    public function __construct(Container $container = null)
    {
        $this->setContainer($container);
    }


    /**
     * run the seed class
     *
     * @return mixed
     */
    public function run(){

    }

    /**
     * call the seed
     *
     * @param string $class
     * @return mixed
     */
    public function call($class){
        $abstarct = "App\\Database\\Seeds\\$class";

        return $this->resolve($abstarct)->run();
    }

    /**
     * Resolve an instance of the given seeder class.
     *
     * @param  string  $class
     * @return Seeder
     */
    public function resolve($abstact)
    {
        if (isset($this->container)) {
            $instance = $this->container->make($abstact);
        } else {
            $instance = new $abstact;
        }

        if (isset($this->command)) {
            $instance->setCommand($this->command);
        }

        return $instance;
    }

    /**
     * @return string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $container
     * @return Seeder
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param Command $command
     * @return Seeder
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }


}
