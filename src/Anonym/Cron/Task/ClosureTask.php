<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Cron\Task;
use Closure;
use InvalidArgumentException;

/**
 * Class ClosureTask
 * @package Anonym\Components\Cron\Task
 */
class ClosureTask extends TaskReposity implements TaskInterface
{

    /**
     * register the command
     *
     * @param mixed $command
     * @return ClosureTask
     */
    public function setCommand($command)
    {
        if(!$command instanceof Closure)
        {
            throw new InvalidArgumentException('Closure task must be a instance of Closure');
        }
        $this->command = $command;

        return $this;
    }

}