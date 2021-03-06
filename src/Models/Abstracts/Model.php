<?php

namespace App\Models\Abstracts;


use App\Lib\DatabaseConnection;
use Closure;
use Faker\Factory;
use PDO;
use PDOStatement;

abstract class Model
{
    public static array $fillable = [];

    public static function select(): array
    {
        $query = DatabaseConnection::connection()->query('SELECT * from ' . static::TABLE);
        $query->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $query->fetchAll();
    }

    public function insert(): PDOStatement|false
    {
        $columns = implode(', ', static::$fillable);
        $bindings = implode(', ', array_map(fn (string $binding) => ":$binding", static::$fillable));

        $query = DatabaseConnection::connection()
            ->prepare("INSERT INTO ".static::TABLE." ($columns) value ($bindings)");

        $result = $query->execute((array)$this);

        return $result ? $query : false;
    }

    public static function fake(Closure $callback, int $count = 1): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $callback(new static, $faker)->insert();
        }
    }
}
