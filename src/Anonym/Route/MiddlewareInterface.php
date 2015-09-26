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
 * the interface of access classes
 *
 * Interface AccessInterface
 * @package Anonym\Route
 */
interface MiddlewareInterface
{


    /**
     * Handle the user access
     *
     * @param Request $request the instance of request
     * @param mixed $role the user role
     * @param callable|null $next work to be done
     * @return mixed
     */
    public function handle(Request $request, $role, callable $next = null);
}
