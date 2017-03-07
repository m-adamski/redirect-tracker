<?php

namespace Core\Services\Session;

use Core\Services\Provider\Provider;

class SessionProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('session', function () {
            return new Session();
        });
    }
}
