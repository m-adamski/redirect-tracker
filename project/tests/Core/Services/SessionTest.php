<?php

namespace Tests\Core\Services;

use Core\Exceptions\RuntimeException;
use Core\Services\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase {

    /**
     * Session Service - get()
     */
    public function testIfGetThrowException() {

        // Get Mock of Session Service
        $sessionMock = $this->getMockBuilder(Session::class)
            ->setMethods(null)
            ->getMock();

        // Set expected Exception message
        $this->expectException(RuntimeException::class);

        // Add twice the same key
        // This should throw Exception
        $sessionMock->add('test', 'Sample value');
        $sessionMock->add('test', 'Sample value');
    }
}
