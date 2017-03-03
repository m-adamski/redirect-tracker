<?php

namespace Core\Services\Routing;

use Core\Services\Provider\Provider;

class RouterProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('router', function () {
            return new Router();
        });
    }
}
