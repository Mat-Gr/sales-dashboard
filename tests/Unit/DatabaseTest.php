<?php


namespace Tests\Unit;


use App\Lib\DatabaseConnection;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    public function testCanSucecsfullyConnectToDatabase()
    {
        $this->expectNotToPerformAssertions();

        $connection = new DatabaseConnection;
    }

}
