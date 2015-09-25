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
 * Class PhpTask
 * @package Anonym\Cron\Task
 */
class PhpTask extends TaskReposity
{

    /**
     * get the php.exe path
     *
     * @return string
     */
    private function  resolvePhpInstalledPath()
    {

        if ((strpos(strtoupper(PHP_OS), 'WIN') === 0)) {
            return 'php';
        }else{
            if (null !== $path = exec('which php')) {
                return $path;
            }
        }
        return 'php';
    }

    /**
     * register the command
     *
     * @param string $command
     * @return $this
     */
    public function setCommand($command)
    {
        $this->command = $this->resolvePhpInstalledPath().' '.$command;

        return $this;
    }
}
