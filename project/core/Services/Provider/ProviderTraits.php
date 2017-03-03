<?php

namespace Core\Services\Provider;

use Core\Application;
use Core\Helpers\Config;

trait ProviderTraits {

    /**
     * Init Providers.
     *
     * @param Application $application
     * @param string $configFile
     */
    private function initProviders(Application $application, string $configFile) {

        // Read Config file - section Providers
        $providersArray = Config::readConfig($configFile, 'providers');

        // Define Providers Collection
        $providersCollection = [];

        // Move every class and register them
        foreach ($providersArray as $providerClass) {
            if (class_exists($providerClass)) {

                /* @var $currentProvider \Core\Services\Provider\Provider */
                $currentProvider = new $providerClass($application);
                $currentProvider->register();

                // Append to Providers Collection
                $providersCollection[] = $currentProvider;
            }
        }

        foreach ($providersCollection as $currentProvider) {
            
            /* @var $currentProvider \Core\Services\Provider\Provider */
            $currentProvider->boot();
        }
    }
}
