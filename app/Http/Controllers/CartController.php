<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    function show()
    {
        return view('cart.cart');
    }
    function add(Request $request, $id)
    {
        $product = Product::find($id);
        Cart::add([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->price,
            'options' => ['thumbnail' => $product->thumbnail],
        ]);
        return redirect('gio-hang');
    }

    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('gio-hang');
    }

    function destroy()
    {
        Cart::destroy();
        return redirect('gio-hang');
    }

    function update(Request $request)
    {
        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return redirect('gio-hang');
    }
}
