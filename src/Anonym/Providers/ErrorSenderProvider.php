<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Providers;

use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\HttpClient\Response;
use Anonym\Support\ErrogBag;
use Anonym\Support\TemplateGenerator;
use Exception;

/**
 * Class ErrorSenderProvider
 * @package Anonym\Providers
 */
class ErrorSenderProvider extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $errors = array_merge(ErrogBag::getExceptions(), ErrogBag::getErrors());

        if (count($errors)) {
            $content = '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ooops!</title>
</head>
<body>

<h1 style="font-family:Open Sans, sans-serif;">Ooops! Something Went Error.</h1>
<hr/>';

            $generator = new TemplateGenerator();
            foreach ($errors as $error) {
                $generator->setContent(
                    '
<br/>
<b>There is an error in: {{ file }}</b>

<hr/>
Message : {{ message }}
<hr/>
Line: : {{ line }}
<hr/>
Error Code: : {{ code }}
<hr/>
'
                );

                $parameters = [$error->getFile(), $error->getMessage(), $error->getLine(), $error->getCode()];
                $content .= $generator->generate($parameters);
            }

            $content .= "</body></html>";
            $response = $this->make('http.response');

            if ($response instanceof Response) {
                $response->setContent($content);
                $response->send();
            }
        }
    }
}
