<?php

namespace App\Services\Facade;

use App\Exceptions\RuntimeException;
use App\Application;

class Facade {

    /**
     * @var Application
     */
    protected static $application;

    /**
     * @var
     */
    protected static $resolvedInstance;

    /**
     * Static constructor.
     *
     * @param Application $application
     */
    public static function init(Application $application) {
        self::$application = $application;
    }

    /**
     * Get the root object behind the facade
     *
     * @return mixed
     */
    public static function getFacadeRoot() {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Get the registered name of the component
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor() {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method');
    }

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string|object $name
     * @return mixed
     */
    protected static function resolveFacadeInstance($name) {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance)) {
            return static::$resolvedInstance;
        }

        return static::$resolvedInstance = static::$app->get($name);
    }

    /**
     * Handle dynamic, static calls to the object
     *
     * @param $method
     * @param $args
     * @return mixed
     * @throws RuntimeException
     */
    public static function __callStatic($method, $args) {

        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new RuntimeException('A facade root has not been set');
        }

        return $instance->$method(...$args);
    }
}
