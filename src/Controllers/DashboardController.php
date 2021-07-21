<?php

namespace App\Controllers;


use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\HtmlResponse;
use App\Lib\JsonResponse;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Faker\Generator;

class DashboardController implements ControllerInterface
{
    public function viewDashboard()
    {
        return new HtmlResponse('dashboard');
    }

    public function seedDatabase()
    {
        Customer::fake(function (Customer $c, Generator $f) {
            $c->first_name = $f->firstName();
            $c->last_name  = $f->lastName();
            $c->email      = $f->email();

            return $c;
        }, random_int(5, 20));

        foreach (Customer::select() as $customer) {
            Order::fake(function (Order $o, Generator $f) use ($customer) {
                $o->country      = $f->countryCode();
                $o->device       = $f->userAgent();
                $o->purchased_at = $f->dateTimeThisYear()
                    ->format('Y-m-d H:i:s');
                $o->customer_id  = $customer->id;

                return $o;
            }, random_int(5, 10));
        }

        foreach (Order::select() as $order) {
            OrderItem::fake(function (OrderItem $oi, Generator $f) use ($order) {
                $oi->order_id = $order->id;
                $oi->ean      = $f->ean13();
                $oi->quantity = $f->numberBetween(1, 200);
                $oi->price    = $f->numberBetween(100, 100000);

                return $oi;
            }, random_int(5, 20));
        }

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
