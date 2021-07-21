<?php

namespace Tests\Feature;

use App\Lib\DatabaseConnection;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
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

    public function testUserCanSeedTheDatabase()
    {
        DatabaseConnection::connection()->exec('DELETE FROM '.OrderItem::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Order::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);

        $client = new Client(['base_uri' => 'http://localhost']);

        $response = $client->request('GET', '/api/seed');

        $this->assertEquals(200, $response->getStatusCode());

        $body = $response->getBody()->getContents();

        $this->assertJson($body);
        $this->assertJsonStringEqualsJsonString(json_encode(['success' => true]), $body);

        $this->assertGreaterThan(1, DatabaseConnection::connection()->query('SELECT count(*) FROM '.OrderItem::TABLE)->fetchColumn());
        $this->assertGreaterThan(1, DatabaseConnection::connection()->query('SELECT count(*) FROM '.Order::TABLE)->fetchColumn());
        $this->assertGreaterThan(1, DatabaseConnection::connection()->query('SELECT count(*) FROM '.Customer::TABLE)->fetchColumn());

        DatabaseConnection::connection()->exec('DELETE FROM '.OrderItem::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Order::TABLE);
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
    }
}
