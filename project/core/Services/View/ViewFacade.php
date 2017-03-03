<?php

namespace Core\Services\View;

use Core\Services\Facade\Facade;

class ViewFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'view';
    }
}
