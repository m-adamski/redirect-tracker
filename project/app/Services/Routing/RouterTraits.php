<?php

namespace App\Services\Routing;

use App\Exceptions\RuntimeException;

trait RouterTraits {

    /**
     * Read Routes Config file.
     *
     * @param string $configFile
     * @throws RuntimeException
     */
    private function readRoutes(string $configFile) {
        if (file_exists($configFile)) {
            require $configFile;
        } else {
            throw new RuntimeException('Routes Config file does not found.');
        }
    }
}
