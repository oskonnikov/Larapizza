<?php
use Illuminate\Http\Request;
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

Route::get('/', 'MainController@index');

Route::get('/cart', 'MainController@cart');

Route::post('/addToCart', function (Request $request) {
  return App::call('App\Http\Controllers\MainController@addToCart' , ['request' => $request]);
});

Route::post('/removeFromCart', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@removeFromCart' , ['request' => $request]);
});

Route::post('/updateCart', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@updateCart' , ['request' => $request]);
});

Route::post('/cartCount', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@cartCount' , ['request' => $request]);
});

Route::post('/setCurrency', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@setCurrency' , ['request' => $request]);
});

Route::get('/checkout', 'MainController@checkout');

Route::post('/setOrder', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@setOrder' , ['request' => $request]);
});

Route::get('/thankyou', function () {
    return view('thankyou');
}); 

Route::get('/about', function () {
    return view('about');
}); 

Route::get('/test', function (Request $request) {
    return App::call('App\Http\Controllers\MainController@test' , ['request' => $request]);
});  

Auth::routes();

Route::get('/home', 'HomeController@index');
