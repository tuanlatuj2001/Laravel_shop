<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }

    function list(Request $request)
    {
        $keyword = '';
        $p = $request->input('status1');

        if ($p == '1') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('order_status', 'pending')
                ->paginate(5);
        } elseif ($p == '2') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('order_status', 'processing')
                ->paginate(5);
        } elseif ($p == '3') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('order_status', 'shipped')
                ->paginate(5);
        } elseif ($p == '4') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('order_status', 'delivered')
                ->paginate(5);
        } elseif ($p == '5') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('order_status', 'canceled')
                ->paginate(5);
        } elseif ($p == '6') {
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('customers.fullname', 'LIKE', '%' . $keyword . '%')
                ->orwhere('order_items.order_code', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $keyword = $request->input('keyword');
            $p = DB::table('order_items')
                ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
                ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
                ->where('customers.fullname', 'LIKE', '%' . $keyword . '%')
                ->orwhere('order_items.order_code', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        }
        $count1 = Order_item::count();
        $count2 = Order_item::where('order_status', 'pending')->count();
        $count3 = Order_item::where('order_status', 'processing')->count();
        $count4 = Order_item::where('order_status', 'shipped')->count();
        $count5 = Order_item::where('order_status', 'delivered')->count();
        $count6 = Order_item::where('order_status', 'canceled')->count();
        $count = [$count1, $count2, $count3, $count4, $count5, $count6];

        $order_items = Order_item::all();
        return view('admin/order/list', compact('order_items', 'p', 'count'));
    }

    function detail($id)
    {
        $details = DB::table('orders')
            ->join('products', 'products.product_id', '=', 'orders.product_id')
            ->select('orders.*', 'products.product_id', 'products.product_name')
            ->where('order_code', $id)
            ->get();

        return view('admin.order.detail', compact('details'));
    }

    function edit($id)
    {
        $p = DB::table('order_items')
            ->join('customers', 'customers.customer_id', '=', 'order_items.customer_id')
            ->select('order_items.*', 'customers.customer_id', 'customers.fullname')
            ->where('item_id', $id)
            ->first();
        return view('admin.order.upddate_status', compact('p'));
    }

    function update(Request $request, $id)
    {
        $order_item = Order_item::find($id);
        $order_item->update([
            'price_item' => $request->price_item,
            'order_code' => $request->order_code,
            'order_status' => $request->order_status,
            'customer_id' => $request->customer_id,
            'user_id' => Auth::id(),
        ]);
        return redirect('/admin/order/list')->with('status', 'Đã cập nhật đơn hàng thành công');
    }

    function edit_detail($id)
    {
        $details = DB::table('orders')
            ->join('products', 'products.product_id', '=', 'orders.product_id')
            ->select('orders.*', 'products.product_id', 'products.product_name', 'products.price')
            ->where('order_id', $id)
            ->first();
        return view('admin/order/update_detail', compact('details'));
    }

    function update_detail(Request $request, $id)
    {
        $a = (int) $request->total_amount;
        $b = (int) $request->product_quantity;
        $order = Order::find($id);
        $order->update([
            'product_quantity' => $request->product_quantity,
            'total_amount' => $a * $b,
            'order_date' => $request->order_date,
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'shipping_address' => $request->shipping_address,
            'note' => $request->note,
            'order_code' => $request->order_code,
            'product_id ' => $request->product_id,
        ]);
        $order_u = Order_item::where('order_code', $order->order_code)->first();
        $order1 = Order::where('order_code', $order_u->order_code)->get();
        $total = 0;
        foreach ($order1 as $k => $v) {
            $a = (int) $v->total_amount;
            $total = $total + $a;
            // dd($a);
        }
        $order_u->update([
            'price_item' => $total,
            'order_code' => $order_u->order_code,
            'order_status' => $order_u->order_status,
            'customer_id' => $order_u->customer_id,
            'user_id' => Auth::id(),
        ]);
        return redirect('/admin/order/list')->with('status', 'Đã cập nhật đơn hàng thành công');
    }
}