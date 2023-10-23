<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_item;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    function show()
    {
        return view('cart.checkout');
    }

    function add(Request $request)
    {
        $a = Customer::select('phone_number')->first();
        $b = $request->phone_number;
        if (Cart::content()->count() > 0) {
            if ($a == $b) {
                $customer_id = Customer::where('phone_number', $request->phone_number)->first();
                $order_code = substr(md5(microtime()), rand(0, 26), 5);
                $order_item = new Order_item([
                    'price_item' => Cart::total(),
                    'order_code' => $order_code,
                    'order_status' => 'pending',
                    'customer_id' => $customer_id->customer_id,
                    'user_id' => null,
                ]);
                $order_item->save();
            } elseif ($a != $b) {
                $customer = new Customer([
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->shipping_address,
                ]);
                $customer->save();

                $customer_id = Customer::select('customer_id', 'phone_number')
                    ->orderBy('customer_id', 'DESC')
                    ->first();

                $order_code = substr(md5(microtime()), rand(0, 26), 5);
                $order_item = new Order_item([
                    'price_item' => Cart::total(),
                    'order_code' => $order_code,
                    'order_status' => 'pending',
                    'customer_id' => $customer_id->customer_id,
                    'user_id' => null,
                ]);
                $order_item->save();
                $data = Cart::content();
                foreach ($data as $k => $v) {
                    $orders = new Order();
                    $orders->product_quantity = $v->qty;
                    $orders->total_amount = $v->total;
                    $orders->order_date = now();
                    $orders->payment_method = $request->payment_method;
                    $orders->shipping_address = $request->shipping_address;
                    $orders->note = $request->note;
                    $orders->order_code = $order_code;
                    $orders->product_id = $v->id;
                    $orders->save();
                }
            }
        }
    }
}