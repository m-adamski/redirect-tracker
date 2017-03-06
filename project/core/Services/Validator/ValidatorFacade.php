<?php

namespace Core\Services\Validator;

use Core\Services\Facade\Facade;

class ValidatorFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'validator';
    }
}
