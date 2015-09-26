<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Console\Schedule;

use Anonym\Cron\Cron as Schedule;
use Anonym\Cron\EventReposity;
use Anonym\Application\Console\Command;
use Anonym\Cron\Task\Task;
use Anonym\Cron\Task\TaskReposity;

class ScheduleRunCommands extends Command
{

    /**
     * signature of command
     *
     * @var string
     */
    protected $name = 'schedule:run';

    /**
     * description of command
     *
     * @var string
     */
    protected $description = 'Run the scheduled commands';

    /**
     * the instance of cron
     *
     * @var Schedule
     */
    protected $schedule;

    /**
     * create a new instance and register schedule instance to $schedule variable
     *
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule = null)
    {
        $this->schedule = $schedule;
        $this->schedule->install(Task::console('schedule:run'));
        parent::__construct();
    }

    /**
     * Komut yakalandığı zaman tetiklenecek fonksiyonlardan biridir
     * @return mixed
     */
    public function fire()
    {
        $schedule = $this->schedule;

        $events = $schedule->dueEvents($schedule->getEvents());

        if (!count($events)) {
            $this->error('There isnt any event from schedule');

            return false;
        }

        foreach ($events as $event) {

            if ($event instanceof TaskReposity) {
                $this->info(sprintf('%s Command is Runnig', $event->getSummaryForDescription()));

                $event->execute();
            }
        }
    }
}