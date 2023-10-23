<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    function index()
    {
        $catagorys = Catalog::where('parent_id', 0)
            ->where('catalog_id', '!=', '23')
            ->get();
        $is_featureds = Product::where('is_featured', 1)->get();
        $dt = Product::where('catalog_id', '1');
        $lt = Product::where('catalog_id', '28');
        return view('shop.home', compact('catagorys', 'is_featureds', 'dt', 'lt'));
    }

    function detail($slug)
    {
        $catagorys = Catalog::where('parent_id', 0)->get();
        $details = Product::where('slug', $slug)->first();
        $relateds = Product::where('cat_id', $details->cat_id)
            ->where('product_id', '!=', $details->product_id)
            ->get();

        return view('shop.detail_product', compact('details', 'catagorys', 'relateds'));
    }

    function post()
    {
        $posts = Post::where('post_status', 0)->paginate(4);
        return view('shop.blog', compact('posts'));
    }

    function detail_post($slug)
    {
        $detali_post = Post::where('post_slug', $slug)->first();
        return view('shop.detail_post', compact('detali_post'));
    }

    function catalog_product($slug)
    {
        $catagorys = Catalog::where('parent_id', 0)
            ->where('catalog_id', '!=', '23')
            ->get();
        $cat1 = Catalog::where('cat_slug', $slug)->first();
        if ($cat1->catagoryChildrent->count()) {
            $cat2 = Catalog::select('catalog_id')
                ->where('parent_id', $cat1->catalog_id)
                ->get();
            $products = Product::whereIn('cat_id', $cat2)->paginate(12);
        } else {
            $products = Product::where('cat_id', $cat1->catalog_id)->paginate(12);
        }

        return view('shop.catalog_prodduct', compact('products', 'cat1', 'catagorys'));
    }
}