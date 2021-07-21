<?php


namespace App\Controllers;


use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\DatabaseConnection;
use App\Lib\JsonResponse;
use App\Models\Order;
use Carbon\Carbon;
use PDO;

class OrdersController implements ControllerInterface
{

    public function index()
    {
        $from = $_GET['from'] ?? Carbon::today()
                ->subMonth()
                ->startOfMonth()
                ->format('Y-m-d H:i:s');
        $to   = $_GET['to'] ?? Carbon::today()
                ->subMonth()
                ->endOfMonth()
                ->format('Y-m-d H:i:s');

        $constraints = 'WHERE purchased_at >= :from AND purchased_at < :to ORDER BY purchased_at DESC';
        $bindings = [
            'from' => $from,
            'to'   => $to,
        ];

        $query = DatabaseConnection::connection()->prepare('SELECT * FROM '.Order::TABLE." $constraints");

        $query->setFetchMode(PDO::FETCH_CLASS, Order::class);
        $query->execute($bindings);

        $orders = $query->fetchAll();

        // TODO - could use some pagination, to avoid large result sets

        return new JsonResponse([
            'collection' => $orders,
            'total'      => count($orders),
        ]);
    }

}
