<?php

namespace Tests\Core\Services;

use Core\Exceptions\RouteNotFoundException;
use Core\Exceptions\RouterException;
use Core\Services\Routing\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RouterTest extends TestCase {

    /**
     * Router Service - get()
     */
    public function testIfGetThrowRouterException() {

        // Define Mock of Router Service
        $routerMock = $this->getMockBuilder(Router::class)
            ->setMethods(null)
            ->getMock();

        // Define Stub of Request
        $requestStub = $this->getMockBuilder(Request::class)
            ->setMethods(['getRequestUri', 'getMethod'])
            ->getMock();

        $requestStub->expects($this->once())
            ->method('getRequestUri')
            ->willReturn('/');

        $requestStub->expects($this->once())
            ->method('getMethod')
            ->willReturn('GET');

        // Expect Exception
        $this->expectException(RouterException::class);

        $routerMock->get('/', 'Test#test');
        $routerMock->dispatch($requestStub);
    }

    /**
     * Router Service - get()
     */
    public function testIfGetThrowRouteNotFoundException() {

        // Define Mock of Router Service
        $routerMock = $this->getMockBuilder(Router::class)
            ->setMethods(null)
            ->getMock();

        // Define Stub of Request
        $requestStub = $this->getMockBuilder(Request::class)
            ->setMethods(['getRequestUri', 'getMethod'])
            ->getMock();

        $requestStub->expects($this->once())
            ->method('getRequestUri')
            ->willReturn('/test');

        $requestStub->expects($this->once())
            ->method('getMethod')
            ->willReturn('GET');

        // Expect Exception
        $this->expectException(RouteNotFoundException::class);

        $routerMock->get('/', 'Test#test');
        $routerMock->dispatch($requestStub);
    }
}
