<?php

namespace App\Services\Routing;

use Phroute\Phroute\RouteCollector;

class Router {

    protected $routesCollection;

    public function __construct() {
        $this->routesCollection = new RouteCollector();
    }
}
