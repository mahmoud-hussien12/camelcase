<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelDoctrine\ORM\Facades\EntityManager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = EntityManager::getRepository('App\Product')->findAll();
        return view('home', compact('products'));
    }
}
