<?php

namespace Core\Services\Alias;

use Core\Helpers\Config;

trait AliasTraits {

    /**
     * Register Aliases.
     *
     * @param string $configFile
     */
    private function registerAliases(string $configFile) {

        // Read Config file - section Aliases
        $aliasesArray = Config::readConfig($configFile, 'aliases');

        // Move every class and init them
        foreach ($aliasesArray as $aliasName => $aliasClass) {
            if (class_exists($aliasClass)) {
                class_alias($aliasClass, $aliasName);
            }
        }
    }
}
