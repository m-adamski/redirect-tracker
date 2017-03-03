<?php

namespace Core\Services\Config;

use Core\Services\Provider\Provider;

class ConfigProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('config', function () {
            return new Config([
                'appConfig' => $this->application->getPath('appConfig')
            ]);
        });
    }
}
