<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Storage;

use function League\Flysystem\Local\unlink;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }
    function add()
    {
        $products = Catalog::All();
        return view('admin.product.add', compact('products'));
    }
    function list(Request $request)
    {
        $keyword = '';
        $products = $request->input('status1');

        if ($products == '1') {
            $products = Product::where('status', 1)->paginate(5);
        } elseif ($products == '0') {
            $products = Product::where('status', 0)->paginate(5);
        } elseif ($products == '2') {
            $products = DB::table('catalogs')
                ->join('products', 'products.cat_id', '=', 'catalogs.catalog_id')
                ->select('products.*', 'catalogs.catalog_id', 'catalogs.catalog_name')
                ->where('products.product_name', 'LIKE', '%' . $keyword . '%')
                ->orwhere('catalogs.catalog_name', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $keyword = $request->input('keyword');
            $products = DB::table('catalogs')
                ->join('products', 'products.cat_id', '=', 'catalogs.catalog_id')
                ->select('products.*', 'catalogs.catalog_id', 'catalogs.catalog_name')
                ->where('products.product_name', 'LIKE', '%' . $keyword . '%')
                ->orwhere('catalogs.catalog_name', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        }
        $count1 = Product::count();
        $count2 = Product::where('status', 1)->count();
        $count3 = Product::where('status', 0)->count();
        $count = [$count1, $count2, $count3];
        return view('admin.product.list', compact('products', 'count'));
    }

    function store(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $imageName = 'thumbnail/' . time() . '_' . $file->getClientOriginalName();
            $file->move('public/thumbnail', $imageName);

            $product = new Product([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'desc' => $request->desc,
                'product_datail' => $request->product_datail,
                'thumbnail' => $imageName,
                'cat_id' => $request->cat_id,
                'status' => $request->status,
                'stock_quantity' => $request->stock_quantity,
                'is_featured' => $request->is_featured,
                'slug' => str_slug($request->product_name, '-'),
            ]);

            $product->save();
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = 'images/' . time() . '_' . $file->getClientOriginalName();
                $request['product_id'] = $product->product_id;
                $request['image'] = $imageName;
                $file->move('public/images', $imageName);
                Image::create($request->all());
            }
        }

        return redirect('/admin/product/list');
    }

    function delete($id)
    {
        $product = Product::findOrFail($id);
        $thumb = 'public/' . $product->thumbnail;
        if (File::exists($thumb)) {
            File::delete($thumb);
        }
        $images = Image::where('product_id', $product->product_id)->get();
        foreach ($images as $image) {
            if (File::exists('public/' . $image->image));
            File::delete('public/' . $image->image);
        }
        $product->delete();
        return back();
    }

    function edit($id)
    {
        $products = Product::find($id);
        $images = DB::table('images')
            ->join('products', 'products.product_id', '=', 'images.product_id')
            ->select('products.*', 'images.*')
            ->where('products.product_id', $id)
            ->get();
        $cats = Catalog::All();
        return view('admin.product.edit', compact('products', 'cats', 'images'));
    }

    function deleteimage($id)
    {
        $images = Image::findOrFail($id);

        if (File::exists('public/' . $images->image)) {
            File::delete('public/' . $images->image);
        }
        $images->delete();
        return back();
    }

    function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        if ($request->hasFile('thumbnail')) {
            if (File::exists('public/' . $products->thumbnail)) {
                File::delete('public/' . $products->thumbnail);
            }
            $file = $request->file('thumbnail');
            $products->thumbnail = 'thumbnail/' . time() . '_' . $file->getClientOriginalName();
            $file->move('public/thumbnail', $products->thumbnail);
            $request['thumbnail'] = $products->thumbnail;
        }
        $products->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'desc' => $request->desc,
            'product_datail' => $request->product_datail,
            'thumbnail' => $products->thumbnail,
            'cat_id' => $request->cat_id,
            'status' => $request->status,
            'stock_quantity' => $request->stock_quantity,
            'is_featured' => $request->is_featured,
            'slug' => str_slug($request->product_name, '-'),
        ]);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = 'images/' . time() . '_' . $file->getClientOriginalName();
                $request['product_id'] = $products->product_id;
                $request['image'] = $imageName;
                $file->move('public/images', $imageName);
                Image::create($request->all());
            }
        }

        return redirect('/admin/product/list');
    }
}
