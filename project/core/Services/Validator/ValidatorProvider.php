<?php

namespace Core\Services\Validator;

use Core\Services\Provider\Provider;

class ValidatorProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('validator', function () {
            return new Validator();
        });
    }
}
