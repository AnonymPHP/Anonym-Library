<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\Route;

use Anonym\Components\HttpClient\Request;
use Anonym\Components\Route\Matchers\NewMatcher;


/**
 * Class Router
 * @package Anonym\Components\Route
 */
class Router implements RouterInterface
{

    /**
     * The all access list
     *
     * @var array
     */
    private $access = [];

    /**
     * Default namespace of controllers
     *
     * @var string
     */
    private $namespace = 'App\Http\Controllers\\';

    /**
     * the instance of RouteMatcherInterface
     *
     * @var RouteMatcherInterface
     */
    private $matcher;

    /**
     * The request currently dispatched
     *
     * @var Request
     */
    private $request;

    /**
     * the instance of ActionDispatcher
     *
     * @var ActionDispatcherInterface
     */
    private $actionDispatcher;

    /**
     * Create a new instance and set Request and matcher variables
     *
     * @param Request|null $request the instance of anonym request
     */
    public function __construct(Request $request = null)
    {
        $this->setRequest($request);
        $this->setAccess(AccessBag::getAccesses());
        $this->setDefaultFilters();
        $this->setMatcher(new NewMatcher($this->getRequest()->getUrl(), null, FilterBag::getFilters()));
        $this->setActionDispatcher(new ActionDispatcher($this->getNamespace(), $this->getAccess(), $this->getRequest()));
    }

    /**
     *  register the default filters without any service provider
     *
     */
    private function setDefaultFilters()
    {
        FilterBag::addFilter('int', '([0-9]+)');
        FilterBag::addFilter('sef', '([a-zA-ZÇŞĞÜÖİçşğüöı0-9+_\-\. ]+)');
        FilterBag::addFilter('string', '([a-zA-Z]+)');
    }

    /**
     * @return RouteMatcherInterface
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**,
     * Set a route matcher instance
     *
     * @param RouteMatcherInterface $matcher
     * @return Router
     */
    public function setMatcher(RouteMatcherInterface $matcher)
    {
        $this->matcher = $matcher;
        return $this;
    }

    /**
     * return a route matcher interface
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Router
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * return the action dispatcher
     *
     * @return ActionDispatcherInterface
     */
    public function getActionDispatcher()
    {
        return $this->actionDispatcher;
    }

    /**
     * Register the action dispatcher
     *
     * @param ActionDispatcherInterface $actionDispatcher
     * @return $this
     */
    public function setActionDispatcher(ActionDispatcherInterface $actionDispatcher)
    {
        $this->actionDispatcher = $actionDispatcher;
        return $this;
    }

    /**
     * return registered namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * register default namespace
     *
     * @param string $namespace
     * @return Router
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * return the registered access list
     *
     * @return array
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Register the access list
     *
     * @param array $access
     * @return Router
     */
    public function setAccess(array $access = [])
    {
        $this->access = $access;
        return $this;
    }


    /**
     * Run the router and check requested uri
     *
     * @throws RouteMatchException
     * @return bool
     */
    public function run()
    {

        $method = strtoupper($this->getRequest()->getMethod());
        $collections = $this->resolveGroupAndWhen(RouteCollector::getRoutes());


        if (!$this->hasAnyRouteInRequestMethod($collections, $method)) {
            $this->callRouteNotFoundCommand();
        }

        $collections = $collections[$method];


        if (false === $return = $this->isThereEquealUrl($collections)) {
            $return = $this->isThereMatchUrl($collections);
        }

        $this->callRouteNotFoundCommand();
        return $return;
    }


    /**
     *
     *
     * @param array $collections
     * @return bool
     */
    protected function isThereMatchUrl($collections)
    {

        foreach ($collections as $collection) {

            if ($this->getMatcher()->match($collection['uri'])) {
                $this->dispatchCollection($collection);
                return true;
            }
        }

        return false;

    }

    /**
     * @param array $collections
     * @return bool
     */
    protected function isThereEquealUrl($collections)
    {
        foreach ($collections as $collection) {

            if ($this->getMatcher()->isUrlEqual($collection['uri'])) {
                $this->dispatchCollection($collection);
                return true;
            }
        }

        return false;
    }

    /**
     * dispatch matched collection
     *
     * @param mixed $collection
     */
    protected function dispatchCollection($collection)
    {
        // find and send group variables
        $group = isset($collection['group']) ? $collection['group'] : null;
        // dispatch action dispatcher
        $content = $this->getActionDispatcher()->dispatch($collection['action'], $group);
        if (is_string($content)) {
            $this->sendContentString($content, $this->getRequest());
        }
    }

    /**
     * determine is there any route in your request method
     *
     * @param string $collections
     * @param string $method
     * @return bool
     */
    protected function hasAnyRouteInRequestMethod($collections, $method)
    {
        return isset($collections[$method]);
    }

    /**
     *  make http not found response with route service
     */
    protected function callRouteNotFoundCommand()
    {
        app('route.not.found');
    }

    /**
     * resolve group and when collections
     *
     * @param array $collections
     * @return array
     */
    protected function resolveGroupAndWhen($collections)
    {
        if (count(RouteCollector::getGroups())) {
            $collections = $this->resolveGroupCollections($collections);
        }

        if (isset($collections['WHEN'])) {
            $collections = $this->resolveWhenCollections($collections['WHEN']);
        }

        if (count($groups = RouteCollector::getGroups())) {
            $collections = $this->resolveGroupCollections($groups);
        }

        return $collections;
    }


    /**
     * resolve when collections
     *
     * @param array $collections
     * @return array
     */
    protected function resolveWhenCollections(array $collections = [])
    {
        foreach ($collections as $index => $collection) {
            if ($this->getMatcher()->matchWhen($collection['uri'])) {

                // registering when tag
                RouteCollector::$firing['when'] = $collection['uri'];
                app()->call($collection['action'], [app('route')]);

                RouteCollector::removeWhen($index);
                break;
            }
        }

        return RouteCollector::getRoutes();
    }

    /**
     * resolve the when collections
     *
     * @param array $groups
     * @return array return the new collections
     */
    private function resolveGroupCollections(array $groups = [])
    {
        foreach ($groups as $index => $group) {
            // register group
            RouteCollector::$firing['group'] = $group;

            app()->call($group['callback'], [app('route')]);

            // unregister the route
            unset(RouteCollector::$firing['group']);
            RouteCollector::removeGroup($index);
        }

        return RouteCollector::getRoutes();
    }

    /**
     * send the content
     *
     * @param string $content
     * @param Request $request
     */
    private function  sendContentString($content = '', Request $request)
    {
        $response = $request->getResponse();
        $response->setContent($content);
        $response->send();
    }
}
