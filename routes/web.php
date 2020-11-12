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
Route::get('/admin', 'AdminController@index');
Route::get('/admin/personal', 'AdminController@getPersonal');
Route::get('/admin/personal/edit', 'AdminController@personalEdit');
Route::post('/admin/personal/save', 'AdminController@personalSave');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/users/add', 'AdminController@usersAdd');
Route::get('/admin/users/edit/{id}', function($id){
    return App::call('App\Http\Controllers\AdminController@usersEdit', ['id' => $id]);
});
Route::post('/admin/user/save', 'AdminController@userSave');
Route::get('/admin/products', 'AdminController@getProducts');
Route::get('/admin/products/edit/{id}', function($id){
    return App::call('App\Http\Controllers\AdminController@productsEdit', ['id' => $id]);
});
Route::get('/admin/products/add', 'AdminController@productsAdd');
Route::post('/admin/products/save', 'AdminController@productsSave');
Route::get('/admin/orders', 'AdminController@getOrders');
Route::get('/admin/order/{id}', function($id){
    return App::call('App\Http\Controllers\AdminController@getOrderByID', ['id' => $id]);
});
Route::get('/admin/settings', 'AdminController@getSettings');
Route::get('/admin/settings/add', 'AdminController@settingsAdd');
Route::post('/admin/settings/save', 'AdminController@settingsSave');
Route::get('/admin/settings/edit/{id}', function($id){
    return App::call('App\Http\Controllers\AdminController@settingsEdit', ['id' => $id]);
});

