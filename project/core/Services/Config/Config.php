<?php

namespace Core\Services\Config;

use Core\Exceptions\RuntimeException;
use DusanKasan\Knapsack\Collection;

class Config {

    protected $configPaths;
    protected $configContentCollection;

    /**
     * Config constructor.
     *
     * @param array $configPaths
     */
    public function __construct(array $configPaths) {
        $this->configPaths = $configPaths;

        // Read Config files
        $this->readConfigs($configPaths);
    }

    /**
     * Get Config Content.
     *
     * @param string $configName
     * @param string|null $section
     * @return mixed
     * @throws RuntimeException
     */
    public function get(string $configName, string $section = null) {

        if ($this->configContentCollection->has($configName)) {
            $configArray = $this->configContentCollection->get($configName);

            return ($section && array_key_exists($section, $configArray)) ? $configArray[$section] : $configArray;
        }

        throw new RuntimeException('Config does not exist.');
    }

    /**
     * Read Config files.
     *
     * @param array $configPaths
     */
    private function readConfigs(array $configPaths) {
        if (!$this->configContentCollection) {
            $this->configContentCollection = new Collection([]);
        }

        foreach ($configPaths as $configPathName => $configPath) {

            if (file_exists($configPath) && !$this->configContentCollection->has($configPathName)) {

                $configContent = require $configPath;
                $this->configContentCollection = $this->configContentCollection->append($configContent, $configPathName);
            } else {
                continue;
            }
        }
    }
}
