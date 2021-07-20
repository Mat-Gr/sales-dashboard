<?php

namespace App\Models;


use App\Lib\DatabaseConnection;
use App\Models\Abstracts\Model;
use PDO;
use PDOStatement;

class Customer extends Model
{
    public const TABLE = 'customers';

    public string $first_name;
    public string $last_name;
    public string $email;

	public static function select(array $columns = []): array
	{
		if (empty($columns)) {
			$columns = ['*'];
		}

		$query = DatabaseConnection::connection()->query('SELECT * from ' . self::TABLE);
		$query->setFetchMode(PDO::FETCH_CLASS, self::class);

		return $query->fetchAll();
	}

    public function insert(): PDOStatement|false
    {
        $query = DatabaseConnection::connection()->prepare("INSERT INTO " . self::TABLE . " (first_name, last_name, email) value (:first_name, :last_name, :email)");

        $result = $query->execute((array)$this);

        return $result ? $query : false;
	}
}
