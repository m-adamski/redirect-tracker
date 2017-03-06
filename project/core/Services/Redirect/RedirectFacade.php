<?php

namespace Core\Services\Redirect;

use Core\Services\Facade\Facade;

class RedirectFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'redirect';
    }
}
