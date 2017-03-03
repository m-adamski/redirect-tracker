<?php

namespace Core\Services\Routing;

use Core\Services\Request\Request;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

class Router {

    protected $routesCollector;
    protected $routesDispatcher;

    /**
     * Router constructor.
     */
    public function __construct() {
        $this->routesCollector = new RouteCollector();
        $this->routesDispatcher = new Dispatcher($this->routesCollector->getData());
    }

    /**
     * Add GET route.
     *
     * @param string $route
     * @param $handler
     */
    public function get(string $route, $handler) {
        $this->addRoute('get', $route, $handler);
    }

    /**
     * Add POST route.
     *
     * @param string $route
     * @param $handler
     */
    public function post(string $route, $handler) {
        $this->addRoute('post', $route, $handler);
    }

    /**
     * Add PUT route.
     *
     * @param string $route
     * @param $handler
     */
    public function put(string $route, $handler) {
        $this->addRoute('put', $route, $handler);
    }

    /**
     * Add DELETE route.
     *
     * @param string $route
     * @param $handler
     */
    public function delete(string $route, $handler) {
        $this->addRoute('delete', $route, $handler);
    }

    /**
     * Add ANY route.
     *
     * @param string $route
     * @param $handler
     */
    public function any(string $route, $handler) {
        $this->addRoute('any', $route, $handler);
    }

    /**
     * Add Group.
     *
     * @param array $filters
     * @param callable $func
     */
    public function group(array $filters, callable $func) {
        $this->routesCollector->group($filters, $func);
        $this->refreshDispatcher();
    }

    /**
     * Dispatch.
     *
     * @param Request $request
     * @return mixed|null
     */
    public function dispatch(Request $request) {
        return $this->routesDispatcher->dispatch($request->getRequestMethod(), $request->getRequestUri());
    }

    /**
     * Universal route add method.
     *
     * @param string $method
     * @param string $route
     * @param $handler
     */
    private function addRoute(string $method, string $route, $handler) {

        // Add Route to Collection and Refresh (ReConstruct) Dispatcher
        $this->routesCollector->$method($route, $handler);
        $this->refreshDispatcher();
    }

    /**
     * Refresh (ReConstruct) Dispatcher
     */
    private function refreshDispatcher() {
        $this->routesDispatcher->__construct($this->routesCollector->getData());
    }
}
