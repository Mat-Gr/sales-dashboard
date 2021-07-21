<?php


namespace App\Models;


use App\Models\Abstracts\Model;

class OrderItem extends Model
{
    public const TABLE = 'order_items';

    public string $ean;
    public int    $quantity;
    public int    $price;
    public int    $order_id;

    public static array $fillable = [
        'ean',
        'quantity',
        'price',
        'order_id',
    ];
}
