<?php
namespace Core\Helpers;

use Core\Exceptions\RuntimeException;

class Config {

    /**
     * Return Config content.
     *
     * @param string $file
     * @param string|null $section
     * @return array|mixed
     * @throws RuntimeException
     */
    public static function readConfig(string $file, string $section = null) {

        // Check if file exist
        if (file_exists($file)) {

            // Include specified file
            $configContent = require $file;
            $configArray = is_array($configContent) ? $configContent : [];

            return ($section && array_key_exists($section, $configArray)) ? $configArray[$section] : $configArray;
        }

        throw new RuntimeException('Config file does not found.');
    }
}
