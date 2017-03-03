<?php

namespace Core\Services\Config;

use Core\Services\Facade\Facade;

class ConfigFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'config';
    }
}
