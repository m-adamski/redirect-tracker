<?php

namespace Core\Services\Session;

use Core\Services\Facade\Facade;

class SessionFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'session';
    }
}
