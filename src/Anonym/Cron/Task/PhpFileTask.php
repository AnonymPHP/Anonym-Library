<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Cron\Task;

/**
 * Class PhpFileTask
 * @package Anonym\Cron\Task
 */
class PhpFileTask extends PhpTask
{

    /**
     * register the command
     *
     * @param string $command
     * @return $this
     */
    public function setCommand($command)
    {
        parent::setCommand($command);

        return $this;
    }

}
