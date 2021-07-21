<?php

namespace App\Models;


use App\Models\Abstracts\Model;

class Customer extends Model
{
    public const TABLE = 'customers';

    public string $first_name;
    public string $last_name;
    public string $email;

    public static array $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

}
