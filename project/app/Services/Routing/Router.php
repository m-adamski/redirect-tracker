<?php

namespace App\Services\Routing;

use App\Services\Request\Request;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

class Router {

    protected $routesCollection;
    protected $routesDispatcher;

    /**
     * Router constructor.
     */
    public function __construct() {
        $this->routesCollection = new RouteCollector();
        $this->routesDispatcher = new Dispatcher($this->routesCollection->getData());
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
        $this->routesCollection->$method($route, $handler);
        $this->routesDispatcher->__construct($this->routesCollection->getData());
    }
}
