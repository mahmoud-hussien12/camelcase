<?php

namespace App\Http\Controllers;

use App\Product;
use App\WishListCart;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class WishCartsController extends Controller
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

        $cart = EntityManager::find('App\WishListCart', $id);
        $products = $cart->getProducts();
        $type = "wish";
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
        $cart = EntityManager::getRepository('App\WishListCart')->findBy(array("user"=>Auth::user()->getAuthIdentifier()));
        //$cart = EntityManager::find('App\WishListCart', $request->user_id);
        $product = EntityManager::find('App\Product', $id);
        if(count($cart)){
            $c = $cart[0];
            $c->addProduct($product);
            EntityManager::persist($c);
            EntityManager::flush();
        }else{
            $cart = new WishListCart();
            $cart->setUser(Auth::user());
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
