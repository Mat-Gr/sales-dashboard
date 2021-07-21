<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

use App\Controllers\DashboardController;
use App\Lib\Router;

echo Router::getResponse([
    Router::get('/', new DashboardController, 'viewDashboard'),
    Router::get('/api/seed', new DashboardController, 'seedDatabase'),
]);
