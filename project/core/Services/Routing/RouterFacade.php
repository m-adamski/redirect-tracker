<?php

namespace Core\Services\Routing;

use Core\Services\Facade\Facade;

class RouterFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'router';
    }
}
