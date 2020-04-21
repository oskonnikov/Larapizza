<?php

namespace App\Http\Controllers;

use App\Products;
use App\Orders;
use Illuminate\Http\Request;
use Auth;

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
        $orders = Orders::where('client_id', Auth::user()->id)->get()->toArray();
        return view('home', ['orders' => $orders]);
    }

}
