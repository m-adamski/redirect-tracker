<?php

namespace Core\Services\Debugger;

use Core\Services\Config\ConfigFacade;
use Symfony\Component\Debug\Debug;

class Debugger {

    /**
     * Enable Service
     */
    public function enable() {

        // Check if Debug is enabled in Config
        if (ConfigFacade::get('appConfig', 'debug')) {
            Debug::enable();
        }
    }
}
