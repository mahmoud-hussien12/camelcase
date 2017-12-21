<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product', function (){
    $cart = new \App\Order();
    $cart = EntityManager::find("App\Order", 1);
    $products = $cart->getOrderProducts();
    return view("home", compact('products'));
    //->getProduct()->getName();
});

Auth::routes();
Route::resource('products', 'ProductsController');
Route::resource('orders', 'OrdersController');
Route::resource('carts', 'CartsController');
Route::resource('ordercarts', 'OrderCartsController');
Route::resource('wishcarts', 'WishCartsController');
Route::get('/home', 'HomeController@index')->name('home');
