<?php

namespace Tests\Unit;

use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public function testCanCorrectlyResolveRegisteredRoute()
    {
        // Setup the main Controller class, which we will attempt to resolve
        $mainController = $this->getMockBuilder(ControllerInterface::class)
            ->addMethods(['testAction'])
            ->getMock();

        $mainController
            ->method('testAction')
            ->willReturn('Test Response');

        $mainController
            ->expects($this->once())
            ->method('testAction');

        // Setup the secondary Controller class, which we don't want to resolve
        $secondaryController = $this->getMockBuilder(ControllerInterface::class)
            ->addMethods(['testAction'])
            ->getMock();

        $secondaryController
            ->method('testAction')
            ->willReturn('Test Response 2');

        $secondaryController
            ->expects($this->never())
            ->method('testAction');

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI']    = '/test?query=1';

        $response = Router::getResponse([
            Router::get('/test', $mainController, 'testAction'),
            Router::get('/test/action', $secondaryController, 'testAction'),
        ]);

        $this->assertEquals(200, http_response_code());
        $this->assertEquals(
            'Test Response',
            $response
        );
    }

    public function testReturns404WhenRouteDoesntExist()
    {
        $response = Router::getResponse([]);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI']    = '/test?query=1';

        $this->assertEquals(404, http_response_code());
        $this->assertStringContainsString(
            '404',
            $response
        );
    }
}
