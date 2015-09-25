<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Http;
use Anonym\Http\Request;
use Anonym\Http\Response;

/**
 * Class FormRequest
 * @package Anonym\Http
 */
class FormRequest extends Request
{

    /**
     * get the response for a forbidden operation
     *
     * @return mixed
     */
    public function forbiddenResponse(){
        return Response::make('Forbidden', 403);
    }

}
