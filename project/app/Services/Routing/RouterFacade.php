<?php

namespace App\Services\Routing;

use App\Services\Facade\Facade;

class RouterFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'router';
    }
}
