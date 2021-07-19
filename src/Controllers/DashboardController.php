<?php

namespace App\Controllers;


use App\Controllers\Interfaces\ControllerInterface;
use App\Lib\HtmlResponse;

class DashboardController implements ControllerInterface
{
    public function viewDashboard()
    {
        return new HtmlResponse('dashboard');
    }

}
