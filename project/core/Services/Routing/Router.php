<?php

namespace Core\Services\Routing;

use Core\Exceptions\RouterException;
use Symfony\Component\HttpFoundation\Request;
use DusanKasan\Knapsack\Collection;

class Router {

    protected $routesCollector;
    protected $controllersCollection;

    /**
     * Router constructor.
     */
    public function __construct() {
        $this->routesCollector = new \AltoRouter();
        $this->controllersCollection = new Collection([]);
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
     * @return mixed
     * @throws RouterException
     */
    public function dispatch(Request $request) {

        // Try to match current Request with one of defined route
        $routerMatch = $this->routesCollector->match($request->getRequestUri(), $request->getMethod());

        // Check if Routes Dispatcher found correct route
        if (is_array($routerMatch) && isset($routerMatch['target']) && count($routerMatch['target']) > 0) {

            $routeController = (isset($routerMatch['target'][0])) ? $routerMatch['target'][0] : null;
            $routeControllerMethod = (isset($routerMatch['target'][1])) ? $routerMatch['target'][1] : null;

            if (class_exists($routeController)) {

                // If Controller is not yet created then create new and append it to controllers collection
                if (!$this->controllersCollection->has($routeController)) {
                    $this->controllersCollection = $this->controllersCollection->append(new $routeController(), $routeController);
                }

                if (method_exists($this->controllersCollection->get($routeController), $routeControllerMethod)) {
                    return $this->controllersCollection->get($routeController)->$routeControllerMethod($request, $routerMatch['params']);
                }
            }

            throw new RouterException('Wrong controller or method');
        } else {
            // 404
            sd('404');
        }

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
        $this->routesCollector->map($method, $route, $handler);
    }
}
