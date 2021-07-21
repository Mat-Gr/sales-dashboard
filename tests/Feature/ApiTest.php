<?php


namespace Tests\Feature;


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    public function testCanGetTotalOrdersCount()
    {
        $client   = new Client(['base_uri' => 'http://localhost']);
        $response = $client->request('GET', '/api/orders');

        $this->assertEquals(200, $response->getStatusCode());

        $body = $response->getBody()->getContents();

        $this->assertJson($body);

        $body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        $this->assertArrayHasKey('total', $body);
        $this->assertIsNumeric($body['total']);
    }
}
