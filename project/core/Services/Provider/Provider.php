<?php

namespace Core\Services\Provider;

use Core\Application;

abstract class Provider {

    protected $application;

    /**
     * Provider constructor.
     *
     * @param Application $application
     */
    public function __construct($application) {
        $this->application = $application;
    }

    public abstract function boot();

    public abstract function register();
}
