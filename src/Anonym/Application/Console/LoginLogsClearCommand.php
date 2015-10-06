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
use Anonym\Facades\LastLogins;

/**
 * Class LoginLogsClearCommand
 * @package Anonym\Application\Console
 */
class LoginLogsClearCommand extends  Command implements HandleInterface
{

    /**
     * the signature of command
     *
     * @var string
     */
    protected $signature = 'logins:clear';

    /**
     * the description of command
     *
     * @var string
     */
    protected $description = 'remove all login logs form your database';

    /**
     * execute this function when this command called
     *
     * @return mixed
     */
    public function handle(){
        if ($this->confirm('We will clean your logins table, Do you want do this? [yes/no]')) {
            LastLogins::cleanLogs();

            $this->info('cleaned all login logs');
        }
    }
}
