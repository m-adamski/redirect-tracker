<?php

namespace Tests\Core\Helpers;

use Core\Helpers\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase {

    /**
     * Config Helper - readConfig()
     */
    public function testReadConfig() {

        // Define Mock of ConfigHelper
        $configHelperMock = $this->getMockClass(Config::class, null);

        // Assert
        $this->assertTrue(is_array($configHelperMock::readConfig(__DIR__ . '/../../../config/app.php')));
    }
}
