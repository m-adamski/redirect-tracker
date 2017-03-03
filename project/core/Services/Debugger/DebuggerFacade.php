<?php

namespace Core\Services\Debugger;

use Core\Services\Facade\Facade;

class DebuggerFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'debugger';
    }
}
