<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch all orders from the database
        $orders = Order::all();

        // Return the view with the orders
        return view('admin.order.index', compact('orders'));
    }
}
