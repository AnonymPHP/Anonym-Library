<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Route;

/**
 * the insterface for access dispatcher
 *
 * Interface AccessDispatcherInterface
 * @package Anonym\Route
 */
interface AccessDispatcherInterface
{

    /**
     * Process the array
     *
     * @param string $access the array of route access
     * @return bool
     */
    public function process($access = '');

}
