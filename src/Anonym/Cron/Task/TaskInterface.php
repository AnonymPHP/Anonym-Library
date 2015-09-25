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


/**
 * Interface TaskInterface
 * @package Anonym\Components\Cron\Task
 */
interface TaskInterface
{

    /**
     * register the command
     *
     * @param mixed $command
     * @return $this
     */
    public function setCommand($command);

}
