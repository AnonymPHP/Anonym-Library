<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Database\Pagination;


use Anonym\Bootstrap\ServiceProvider;
use Anonym\Components\HttpClient\Request;
use Anonym\Facades\App;
use GUMP;
/**
 * Class PaginationServiceProvider
 * @package Anonym\Components\Database\Pagination
 */
class PaginationServiceProvider extends ServiceProvider
{


    /**
     * register the provider
     *
     * @return mixed
     */
    public function register()
    {
        Paginator::setCurrentPageFinder(function(){
            if (isset($_GET['page'])) {
                $page = first(GUMP::xss_clean([$_GET['page']]));

                return $page;
            }else{
                return 1;
            }
        });


        $request = App::make('http.request');
        Paginator::setRequestPathFinder(function() use ($request){
            if ($request instanceof Request) {
                return $request->getBaseWithoutQuery();
            }
        });
    }
}
