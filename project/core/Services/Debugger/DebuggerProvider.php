<?php

namespace Core\Services\Debugger;

use Core\Services\Provider\Provider;

class DebuggerProvider extends Provider {

    public function boot() {
        DebuggerFacade::enable();
    }

    public function register() {
        $this->application->bind('debugger', function () {
            return new Debugger();
        });
    }
}
