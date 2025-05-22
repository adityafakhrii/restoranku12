<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grand_total');

        $todayOrders = Order::whereDate('created_at', now())->count();
        $todayRevenue = Order::whereDate('created_at', now())->sum('grand_total');

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'todayOrders', 'todayRevenue'));
    }
}
