<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class DashboardTest extends TestCase
{

    public function testUserCanViewTheDashboard()
    {
        $client   = new Client(['base_uri' => 'http://localhost']);
        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());

        $body = $response->getBody()->getContents();

        $this->assertStringContainsString('Dashboard', $body);
    }
}
