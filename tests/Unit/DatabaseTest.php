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
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
        DatabaseConnection::connection()
            ->exec("INSERT INTO ".Customer::TABLE." (first_name, last_name, email) values ('Jane', 'Doe', 'jane.doe@example.com')");
        $id = DatabaseConnection::connection()->lastInsertId();

        $rows = Customer::select(['first_name', 'last_name', 'email']);

        $this->assertIsArray($rows);
        $this->assertNotEmpty($rows);

        $customer = $rows[0];

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($customer->first_name, 'Jane');
        $this->assertEquals($customer->last_name, 'Doe');
        $this->assertEquals($customer->email, 'jane.doe@example.com');
        $this->assertEquals($customer->id, $id);

        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
    }
}
