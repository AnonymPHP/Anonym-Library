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
use Anonym\Support\ErrogBag;

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
            foreach ($errors as $error) {

            }
        }
    }
}
