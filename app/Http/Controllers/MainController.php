<?php

namespace App\Http\Controllers;

use Auth;
use App\History;
use App\Orders;
use App\Products;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['addToCart', 'index', 'cart', 'removeFromCart', 'updateCart', 'checkout']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $currency = session()->get('cart_currency');
        $factor = 1;
        $currency_icon = '$';
        if($currency == 'EUR'){
            $factor = 0.92;
            $currency_icon = '€';
        }
        return view('index', ['products' => $products, 'factor' => $factor, 'currency_icon' => $currency_icon]);
    }

    public function addToCart(Request $request)
    {
        $result = [];
        $post = $request->all();
        $product = Products::where('id', $post['data-product'])->first();
        $currency = session()->get('cart_currency');
        $factor = 1;
        if($currency == 'EUR'){
            $factor = 0.92;
        }
        $product['product_price'] = $product['product_price'] * $factor;
        if(!$request->session()->has('cart.' . $post['data-product'] . '.price')){
            $request->session()->put('cart.' . $post['data-product'] . '.price', $product['product_price']);
            $request->session()->put('cart.' . $post['data-product'] . '.count', 1);
            $request->session()->save();
        }
        else{
            $new_count = $request->session()->get('cart.' . $post['data-product'] . '.count') + 1;
            $request->session()->put('cart.' . $post['data-product'] . '.count', $new_count);
            $request->session()->save();
        }

        $cart = $request->session()->get('cart');
        $cart_total_price = 0;
        $cart_total_count = 0;
        foreach($cart as $c){
            $cart_total_price += $c['price'] * $c['count'];
            $cart_total_count += $c['count'];
        }
        $request->session()->put('cart_total.count', $cart_total_count);
        $request->session()->put('cart_total.price', $cart_total_price);
        $result['total_count'] = $cart_total_count;
        $result['status'] = 0;
        return json_encode($result);
    }

    public function removeFromCart(Request $request)
    {
        $result = [];
        $post = $request->all();
        if($request->session()->has('cart.' . $post['data-product'])){
            $request->session()->forget('cart.' . $post['data-product']);
            $request->session()->save();
        }
        $cart = $request->session()->get('cart');
        $cart_total_price = 0;
        $cart_total_count = 0;
        foreach($cart as $c){
            $cart_total_price += $c['price'] * $c['count'];
            $cart_total_count += $c['count'];
        }
        $request->session()->put('cart_total.count', $cart_total_count);
        $request->session()->put('cart_total.price', $cart_total_price);
        $result['total_count'] = $cart_total_count;
        $result['status'] = 0;
        return json_encode($result);
    }

    public function updateCart(Request $request)
    {
        $result = [];
        $post = $request->all();
        if($request->session()->has('cart.' . $post['data-product'])){
            if($post['data-count'] == 0){
                $request->session()->forget('cart.' . $post['data-product']);
            }
            else{
                $request->session()->put('cart.' . $post['data-product'] . '.count', $post['data-count']);
            }
            $request->session()->save();
        }
        $cart = $request->session()->get('cart');
        $cart_total_price = 0;
        $cart_total_count = 0;
        $result['selected_total_price'] = 0;
        foreach($cart as $k => $c){
            $cart_total_price += $c['price'] * $c['count'];
            $cart_total_count += $c['count'];
            if($k == $post['data-product']){
                $result['selected_total_price'] = $c['price'] * $c['count'];
            }
        }
        $request->session()->put('cart_total.count', $cart_total_count);
        $request->session()->put('cart_total.price', $cart_total_price);
        $result['total_price'] = number_format($cart_total_price, 2);
        $result['total_count'] = $cart_total_count;
        $result['selected_total_price'] = number_format($result['selected_total_price'], 2);
        $result['status'] = 0;
        return json_encode($result);
    }

    public function setCurrency(Request $request)
    {
        $result = [];
        $post = $request->all();
        $request->session()->put('cart_currency', $post['data-currency']);
        $request->session()->save();
        $result['status'] = 0;
        return json_encode($result);
    }

    public function cart(Request $request)
    {
        $factor = 1;
        $currency_icon = '$';
        $currency = session()->get('cart_currency');
        if($currency == 'EUR'){
            $factor = 0.92;
            $currency_icon = '€';
        }
        $cart = $request->session()->get('cart');
        if(!empty($cart)){
            $selected_ids = array_keys($cart);
            $products = Products::whereIn('id', $selected_ids)->get()->keyBy('id')->toArray();
            $total = 0;
            foreach($products as $k => &$product){
                $product['product_price'] = $product['product_price'] * $factor;
                $product['total'] = $product['product_price'] * $cart[$k]['count'];
                $product['count'] = $cart[$k]['count'];
                $total += $product['total'];
            }
        }
        else{
            $products = [];
            $total = 0;
        }

        return view('cart', ['products' => $products, 'currency_icon' => $currency_icon, 'total' => $total]);
    }

    public function cartCount(Request $request)
    {
        $result = [];
        $cart_total = $request->session()->get('cart_total');
        $result['total_count'] = 0;
        if(!empty($cart_total)){
            $result['total_count'] = $cart_total['count'];
        }
        if(!$request->session()->has('cart_currency')){
            $request->session()->put('cart_currency', 'USD');
            $request->session()->save();
        }
        $result['currency'] = $request->session()->get('cart_currency');
        $result['status'] = 0;
        return json_encode($result);
    }

    public function checkout(Request $request)
    {
        $factor = 1;
        $currency_icon = '$';
        $currency = session()->get('cart_currency');
        if($currency == 'EUR'){
            $factor = 0.92;
            $currency_icon = '€';
        }
        $cart = $request->session()->get('cart');
        if(empty($cart)){ 
            return redirect('/');
        }
        $selected_ids = array_keys($cart);
        $products = Products::whereIn('id', $selected_ids)->get()->keyBy('id')->toArray();
        $total = 0;
        foreach($products as $k => &$product){
            $product['product_price'] = $product['product_price'] * $factor;
            $product['total'] = $product['product_price'] * $cart[$k]['count'];
            $product['count'] = $cart[$k]['count'];
            $total += $product['total'];
        }
        return view('checkout', ['products' => $products, 'currency_icon' => $currency_icon, 'total' => $total]);
    }


    public function setOrder(Request $request)
    {
        $result = [];
        $post = $request->all();
        $cart = $request->session()->get('cart');
        $currency = session()->get('cart_currency');
        $cart_total = $request->session()->get('cart_total');
        if(Auth::user()->id > 0)
        {
            $post['email'] = Auth::user()->email;  
        } 
        $client = User::where('email', $post['email'])->first();
        $new_client = ['name' => 'user' . rand(500, 1000), 'email' => $post['email'], 'phone' => $post['phone'],
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'full_address' => $post['address_zip'] . ', ' . $post['street_address'] . ', ' . $post['address_misc'] . ', ' . $post['address_city'],
        ];
        $client_id = 0;
        if(!$client){
            $client_id = User::insertGetId($new_client);
        }
        else{
            $client_id = $client->id;
            $client->update($new_client);
        }

        $new_order = ['client_id' => $client_id, 'order_total' => $cart_total['price'],
            'order_currency' => $currency, 'payment_method' => $post['payment_method']];
        $order_id = Orders::insertGetId($new_order);

        $history = [];
        foreach($cart as $k => $c){
            $history[$k]['order_id'] = $order_id;
            $history[$k]['product_id'] = $k;
            $history[$k]['product_count'] = $c['count'];
        }
        $history_id = History::insert($history);
        $request->session()->forget('cart');
        $request->session()->forget('cart_total');
        $request->session()->save();
        $result['status'] = 0;
        return json_encode($result);
    }


    public function test(Request $request)
    {
        //$cart = $request->session()->get('cart');
        // $request->session()->forget('cart');
        $cart = $request->session()->all();
        echo '<pre>';
        print_r($cart);
        echo '</pre>';
        echo 'tested';
        /*         $insert = ['product_name' => 'TestPizza', 'product_price' => rand(500, 1000)];
                Products::insert($insert);
                $products = Products::all();
                return view('cart', ['cart' => $cart]); */
    }

}
