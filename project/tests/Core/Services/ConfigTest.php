<?php

namespace Tests\Core\Services;

use Core\Services\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase {

    /**
     * Config Service - get()
     */
    public function testGet() {

        // Get Mock
        $configMock = $this->getMockBuilder(Config::class)
            ->setConstructorArgs([['appConfig' => __DIR__ . '/../../../config/app.php']])
            ->setMethods(null)
            ->getMock();

        $this->assertArrayHasKey('providers', $configMock->get('appConfig'));
    }
}
