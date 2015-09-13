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
use Anonym\Components\HttpClient\Request;
use Anonym\Components\HttpClient\Response;
use Anonym\Facades\App;

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
