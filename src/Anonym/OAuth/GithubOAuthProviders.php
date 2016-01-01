<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\OAuth;


use Anonym\Application\ServiceProvider;
use Anonym\Facades\Redirect;
use Anonym\Facades\Request;
use Anonym\Facades\Route;
use Anonym\Facades\Session;

/**
 * Class GithubOAuthProviders
 * @package Anonym\OAuth
 */
class GithubOAuthProviders extends ServiceProvider
{

    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        $github = new Github();

        Route::get('/github/login', function () use ($github) {
            Session::set('state', $state = hash('sha256', microtime(TRUE) . rand() . Request::ip()));

            if (Session::has('access_token')) {
                Session::delete('access_token');
            }

            $params = array(
                'client_id' => OAUTH2_CLIENT_ID,
                'redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
                'scope' => 'user',
                'state' => $state
            );
            // Redirect the user to Github's authorization page

            Redirect::to('Location: ' . $github->getAuthorizeURL() . '?' . http_build_query($params));
        });
    }
}
