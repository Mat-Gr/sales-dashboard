<?php


namespace Tests\Feature;


use App\Lib\DatabaseConnection;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
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

    public function testCanGetGroupedOrdersCount()
    {
        $client = new Client(['base_uri' => 'http://localhost']);
        $client->request('GET', '/api/seed');

        $client   = new Client(['base_uri' => 'http://localhost']);
        $response = $client->request('GET', '/api/orders/grouped');

        $this->assertEquals(200, $response->getStatusCode());

        $body = $response->getBody()->getContents();

        $this->assertJson($body);

        $body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        $this->assertArrayHasKey('collection', $body);
        $this->assertArrayHasKey('purchase_date', $body['collection'][0]);
        $this->assertArrayHasKey('total', $body['collection'][0]);

        DatabaseConnection::connection()->exec('DELETE FROM '.OrderItem::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Order::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
    }
}
