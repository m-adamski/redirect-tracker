<?php

namespace Tests\Core\Services;

use Core\Services\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ValidatorTest extends TestCase {

    /**
     * Validator Service - validate()
     */
    public function testValidate() {

        // Define Mock
        $validatorMock = $this->getMockBuilder(Validator::class)
            ->setMethods(null)
            ->getMock();

        // Define Stub of Request
        $requestStub = $this->getMockBuilder(Request::class)
            ->setMethods(null)
            ->getMock();

        $requestStub->request->set('test', 'Test');
        $this->assertTrue($validatorMock->validate($requestStub, ['test' => 'required'])->status());
    }
}
