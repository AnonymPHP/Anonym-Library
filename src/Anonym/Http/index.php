<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

include "vendor/autoload.php";

$request = new \Anonym\Http\Request();
echo $request->getBaseUri();