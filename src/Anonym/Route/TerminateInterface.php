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

use Anonym\Http\Request;

/**
 * Interface TerminateInterface
 * @package Anonym\Route
 */
interface TerminateInterface
{

    /**
     * terminate the request
     *
     * @param Request $request
     * @return mixed
     */
    public function terminate(Request $request);

}
