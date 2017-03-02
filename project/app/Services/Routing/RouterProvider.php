<?php

namespace App\Services\Routing;

use App\Services\Provider\Provider;

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
