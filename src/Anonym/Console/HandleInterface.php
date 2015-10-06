<?php

    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Console;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Interface HandleInterface
     * @package Anonym\Application\Console
     */
    interface HandleInterface
    {

        /**
         * handle and execute the command
         *
         * @return mixed
         */
        public function handle();
    }
