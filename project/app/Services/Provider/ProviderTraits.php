<?php

namespace App\Services\Provider;

use App\Application;
use App\Helpers\Config;
use DusanKasan\Knapsack\Collection;

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
        $providersCollection = new Collection([]);

        // Move every class and register them
        foreach ($providersArray as $providerClass) {
            if (class_exists($providerClass)) {

                /* @var $currentProvider \App\Services\Provider\Provider */
                $currentProvider = new $providerClass($application);
                $currentProvider->register();

                // Append to Providers Collection
                $providersCollection->append($currentProvider);
            }
        }

        // When all Providers are registered then run boot function on each of them
        $providersCollection->each(function ($currentProvider) {

            /* @var $currentProvider \App\Services\Provider\Provider */
            $currentProvider->boot();
        });
    }
}
