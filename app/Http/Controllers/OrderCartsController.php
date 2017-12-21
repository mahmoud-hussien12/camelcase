<?php

namespace App\Http\Controllers;

use App\OrderCart;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class OrderCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cart = EntityManager::find('App\OrderCart', $id);
        $products = $cart->getOrderCartProducts();
        $type = "order";
        return view("cartProducts", compact('products', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cart = EntityManager::find('App\OrderCart', $request->user_id);
        $product = EntityManager::find('App\Product', $id);
        $price = 0.0;
        if($product->type = "normal"){
            $price = $product->getPrice();
        }else{
            $price = $product->getNewPrice();
        }
        if($cart){
            $cart->addProduct($product);
            $cart->setTotalPrice($cart->getTotalPrice()+$price);
            EntityManager::persist($cart);
            EntityManager::flush();
        }else{
            $cart = new OrderCart();
            $cart->setTotalPrice($price);
            $cart->addProduct($product);
            EntityManager::persist($cart);
            EntityManager::flush();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
