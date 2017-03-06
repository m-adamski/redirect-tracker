<?php

namespace Core\Services\Redirect;

use Core\Services\Provider\Provider;

class RedirectProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('redirect', function () {
            return new Redirect();
        });
    }
}
