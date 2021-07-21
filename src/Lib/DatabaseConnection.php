<?php


namespace App\Lib;


use PDO;

class DatabaseConnection
{
    private static PDO $connection;

    public static function connection()
    {
        if (!isset(self::$connection)) {
            $host     = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'testing' ? '127.0.0.1:9906' : 'mariadb';
            $db       = Config::get('MYSQL_DATABASE');
            $user     = Config::get('MYSQL_USER');
            $password = Config::get('MYSQL_PASSWORD');

            $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$connection = $conn;
        }

        return self::$connection;
    }

}
