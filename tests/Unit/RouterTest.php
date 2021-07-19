<?php

namespace Tests\Unit;

use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\Abstracts\BaseResponse;
use App\Lib\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public function testCanCorrectlyResolveRegisteredRoute()
    {
        // Setup the main Controller and Response, which we will attempt to resolve
        $mainController = $this->getMockBuilder(ControllerInterface::class)
            ->addMethods(['testAction'])
            ->getMock();

        $mainResponse = $this->getMockForAbstractClass(BaseResponse::class);

        $mainResponse
            ->method('__toString')
            ->willReturn('Test Response');

        $mainController
            ->method('testAction')
            ->willReturn($mainResponse);

        $mainController
            ->expects($this->once())
            ->method('testAction');

        // Setup the secondary Controller and Response, which we don't want to resolve
        $secondaryController = $this->getMockBuilder(ControllerInterface::class)
            ->addMethods(['testAction'])
            ->getMock();

        $secondaryResponse = $this->getMockForAbstractClass(BaseResponse::class);

        $secondaryResponse
            ->method('__toString')
            ->willReturn('Test Response 2');

        $secondaryController
            ->method('testAction')
            ->willReturn($secondaryResponse);

        $secondaryController
            ->expects($this->never())
            ->method('testAction');

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI']    = '/test?query=1';

        $response = Router::getResponse([
            Router::get('/test/action', $secondaryController, 'testAction'),
            Router::get('/test', $mainController, 'testAction'),
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
