<?php


namespace Tests\Unit;


use App\Lib\DatabaseConnection;
use App\Models\Customer;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    public function testCanSucecsfullyConnectToDatabase()
    {
        $this->expectNotToPerformAssertions();

        DatabaseConnection::connection();
    }

    public function testCanInsertIntoCustomersTable()
    {
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);

        $customer = new Customer;

        $customer->first_name = 'John';
        $customer->last_name  = 'Doe';
        $customer->email      = 'john.doe@example.com';

        $result = $customer->insert();

        $this->assertNotFalse($result);
        $this->assertEquals(1, $result->rowCount());
        $this->assertGreaterThan(0,
            DatabaseConnection::connection()->lastInsertId());

        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
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

    public function testCanFakeCustomer()
    {
        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);

        $faked = [];

        Customer::fake(function (Customer $customer, Generator $faker) use (&$faked) {
            $customer->first_name = $faker->firstName();
            $customer->last_name  = $faker->lastName();
            $customer->email      = $faker->email();

            $faked = (array)$customer;

            return $customer;
        });

        $saved = Customer::select(['first_name', 'last_name', 'email'])[0];

        $this->assertInstanceOf(Customer::class, $saved);
        $this->assertEquals($saved->first_name, $faked['first_name']);
        $this->assertEquals($saved->last_name, $faked['last_name']);
        $this->assertEquals($saved->email, $faked['email']);

        DatabaseConnection::connection()->exec('DELETE FROM '.Customer::TABLE);
    }
}
