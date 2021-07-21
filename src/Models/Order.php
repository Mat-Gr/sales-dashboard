<?php


namespace App\Models;


use App\Models\Abstracts\Model;

class Order extends Model
{
    public const TABLE = 'orders';

    public string $country;
    public string $device;
    public string $purchased_at;
    public int    $customer_id;

    public static array $fillable = [
        'country',
        'device',
        'purchased_at',
        'customer_id',
    ];
}
