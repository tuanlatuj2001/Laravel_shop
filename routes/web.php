<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogPostController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderitemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/catalog/text', [MenuController::class, 'menu']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show']);

    //admin
    Route::get('admin', [DashboardController::class, 'show']);

    //Users
    Route::get('admin/user/list', [AdminUserController::class, 'list']);
    Route::get('admin/user/add', [AdminUserController::class, 'add']);
    Route::post('admin/user/store', [AdminUserController::class, 'store']);
    Route::get('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('delete_user');
    Route::get('admin/user/action', [AdminUserController::class, 'action']);
    Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('edit.user');
    Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');

    //Catalog
    Route::get('admin/catalog/list', [CatalogController::class, 'list']);
    Route::get('admin/catalog/add', [CatalogController::class, 'add']);
    Route::post('admin/catalog/store', [CatalogController::class, 'store']);
    Route::get('admin/catalog/edit/{catalog_id}', [CatalogController::class, 'edit'])->name('edit.catalog');
    Route::post('admin/catalog/update/{catalog_id}', [CatalogController::class, 'update'])->name('catalog.update');
    Route::get('admin/catalog/delete/{idcatalog_id}', [CatalogController::class, 'delete'])->name('delete.catalog');

    //product
    Route::get('admin/product/add', [ProductController::class, 'add']);
    Route::get('admin/product/list', [ProductController::class, 'list']);
    Route::post('admin/product/store', [ProductController::class, 'store']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete'])->name('delete.product');
    route::delete('admin/product/deleteimage/{id}', [ProductController::class, 'deleteimage'])->name('deleteimage.product');
    Route::post('admin/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

    //post
    Route::get('admin/post/add', [PostController::class, 'add']);
    Route::post('admin/post/store', [PostController::class, 'store']);
    Route::get('admin/post/list', [PostController::class, 'list']);
    Route::get('admin/post/edit/{id}', [PostController::class, 'edit'])->name('edit.post');
    Route::post('admin/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('admin/post/delete/{id}', [PostController::class, 'delete'])->name('delete.post');

    //Catalog_post
    Route::get('admin/catalog_post/list', [CatalogPostController::class, 'list']);
    Route::get('admin/catalog_post/add', [CatalogPostController::class, 'add']);
    Route::post('admin/catalog_post/store', [CatalogPostController::class, 'store']);
    Route::get('admin/catalog_post/edit/{id}', [CatalogPostController::class, 'edit'])->name('edit.catalog_post');
    Route::post('admin/catalog_post/update/{id}', [CatalogPostController::class, 'update'])->name('catalog_post.update');
    Route::get('admin/catalog_post/delete/{id}', [CatalogPostController::class, 'delete'])->name('delete.catalog_post');

    //page
    Route::get('admin/page/add', [PageController::class, 'add']);
    Route::post('admin/page/store', [PageController::class, 'store']);
    Route::get('admin/page/list', [PageController::class, 'list']);
    Route::get('admin/page/edit/{id}', [PageController::class, 'edit'])->name('edit.page');
    Route::post('admin/page/update/{id}', [PageController::class, 'update'])->name('page.update');
    Route::get('admin/page/delete/{id}', [PageController::class, 'delete'])->name('delete.page');

    //order
    Route::get('admin/order/list', [OrderController::class, 'list']);
    Route::get('admin/order/detail/{id}', [OrderController::class, 'detail'])->name('detail.order');
    Route::get('admin/order/edit/{id}', [OrderController::class, 'edit'])->name('edit.order');
    Route::post('admin/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('admin/order/edit_detail/{id}', [OrderController::class, 'edit_detail'])->name('edit_detail.order');
    Route::post('admin/order/update_detail/{id}', [OrderController::class, 'update_detail'])->name('order.update_detail');
    //dashboard
    // Route::get('admin/dashboard/show_dashboard', [DashboardController::class, 'show_dashboard']);
});

Route::get('/', [SiteController::class, 'index']);
Route::get('/san-pham/{slug}.html', [SiteController::class, 'detail'])->name('detail');

Route::get('/bai-viet', [SiteController::class, 'post'])->name('post');
Route::get('/bai-viet/{slug}', [SiteController::class, 'detail_post'])->name('detail_post');
route::get('/san-pham/{slug}', [SiteController::class, 'catalog_product'])->name('catalog_product');

Route::get('/gio-hang', [CartController::class, 'show'])->name('cart');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.romove');
Route::get('/cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/thanh-toan', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/thanh-toan/add', [CheckoutController::class, 'add']);