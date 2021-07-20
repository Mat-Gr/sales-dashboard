<?php


namespace Tests\Unit;


use App\Lib\DatabaseConnection;
use App\Models\Customer;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    public function testCanSucecsfullyConnectToDatabase()
    {
        $this->expectNotToPerformAssertions();

        DatabaseConnection::connection();
    }

    public function testCanSelectFromCustomersTable()
    {
        $rows = Customer::select(['first_name', 'last_name', 'email']);

        $this->assertIsArray($rows);
        $this->assertInstanceOf(Customer::class, $rows[0]);
    }

}
