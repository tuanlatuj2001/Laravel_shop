<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
    }
    function show()
    {
        $success = Order_item::where('order_status', 'delivered')->count();
        $total = DB::table('order_items')
            ->where('order_status', 'delivered')
            ->sum('price_item');
        $pending = Order_item::where('order_status', 'pending')->count();
        $processing = Order_item::where('order_status', 'processing')->count();
        $cancele = Order_item::where('order_status', 'cancele')->count();
        $count_pending = $pending + $processing;
        $count = [$success, $count_pending, $cancele, $total];
        $orders = DB::table('order_items')
            ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
            ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
            ->paginate(5);
        return view('admin.dashboard', compact('orders', 'count'));
    }
}
